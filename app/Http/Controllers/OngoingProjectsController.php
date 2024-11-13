<?php

namespace App\Http\Controllers;

use App\Models\OngoingProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OngoingProjectsController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $ongoingProjects = OngoingProjects::latest()->get();
        return view('website.projects.ongoing-projects', compact('ongoingProjects'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ongoingProjects = OngoingProjects::latest()->get();
        return view('admin.projects.ongoing-projects', compact('ongoingProjects'));
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
            'capacity' => 'required|numeric',
            'location' => 'required|string',
        ]);

        OngoingProjects::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Ongoing project added successfully');
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
        $ongoingProject = OngoingProjects::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $ongoingProject->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Ongoing project updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ongoingProject = OngoingProjects::findOrFail($id);

        $ongoingProject->delete();

        return redirect()->back()->with('success', 'Ongoing project deleted successfully');
    }
}
