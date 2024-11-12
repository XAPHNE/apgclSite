<?php

namespace App\Http\Controllers;

use App\Models\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class RosterController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $rosters = Roster::latest()->get();
        return view('website.documents.rosters', compact('rosters'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rosters = Roster::latest()->get();
        return view('admin.documents.roster', compact('rosters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'required|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
            'is_header' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Rosters/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Rosters/'), $fileName);
        }

        Roster::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'is_header' => $request->boolean('is_header'),
        ]);

        return redirect()->back()->with('success', 'Roster added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roster = Roster::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
            'is_header' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($roster->downloadLink))) {
                File::delete(public_path($roster->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Rosters/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Rosters/'), $fileName);
        } else {
            $filePath = $roster->downloadLink;
        }

        $roster->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'is_header' => $request->boolean('is_header'),
        ]);

        return redirect()->back()->with('success', 'Roster updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roster = Roster::findOrFail($id);

        if (File::exists(public_path($roster->downloadLink))) {
            // File::delete(public_path($roster->downloadLink));
        }

        $roster->delete();

        return redirect()->back()->with('success', 'Roster deleted successfully');
    }
}
