<?php

namespace App\Http\Controllers;

use App\Models\Apprenticeship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ApprenticeshipController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $apprenticeships = Apprenticeship::latest()->get();
        return view('website.career.apprenticeship', compact('apprenticeships'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apprenticeships = Apprenticeship::latest()->get();
        return view('admin.career.apprenticeship', compact('apprenticeships'));
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
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Career/Apprenticeships/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Career/Apprenticeships/'), $fileName);
        }

        Apprenticeship::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Apprenticeship added successfully');
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
        $apprenticeship = Apprenticeship::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($apprenticeship->downloadLink))) {
                File::delete(public_path($apprenticeship->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Career/Apprenticeships/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Career/Apprenticeships/'), $fileName);
        } else {
            $filePath = $apprenticeship->downloadLink;
        }

        $apprenticeship->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Apprenticeship updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apprenticeship = Apprenticeship::findOrFail($id);

        if (File::exists(public_path($apprenticeship->downloadLink))) {
            // File::delete(public_path($apprenticeship->downloadLink));
        }

        $apprenticeship->delete();

        return redirect()->back()->with('success', 'Apprenticeship deleted successfully');
    }
}