<?php

namespace App\Http\Controllers;

use App\Models\DisasterManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class DisasterManagementController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $disasterManagements = DisasterManagement::latest()->get();
        return view('website.disaster-management', compact('disasterManagements'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $disasterManagements = DisasterManagement::latest()->get();
        return view('admin.disaster-management', compact('disasterManagements'));
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
            $filePath = 'admin-assets/Disaster Management/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Disaster Management/'), $fileName);
        }

        DisasterManagement::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Disaster Management added successfully');
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
        $disasterManagement = DisasterManagement::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($disasterManagement->downloadLink))) {
                File::delete(public_path($disasterManagement->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Disaster Management/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Disaster Management/'), $fileName);
        } else {
            $filePath = $disasterManagement->downloadLink;
        }

        $disasterManagement->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Disaster Management updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disasterManagement = DisasterManagement::findOrFail($id);

        if (File::exists(public_path($disasterManagement->downloadLink))) {
            // File::delete(public_path($disasterManagement->downloadLink));
        }

        $disasterManagement->deleted_by = auth()->id();
        $disasterManagement->save();

        $disasterManagement->delete();

        return redirect()->back()->with('success', 'Disaster Management deleted successfully');
    }
}
