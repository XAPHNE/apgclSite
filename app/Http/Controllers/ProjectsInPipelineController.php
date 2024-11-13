<?php

namespace App\Http\Controllers;

use App\Models\ProjectsInPipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProjectsInPipelineController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $projectsInPipelines = ProjectsInPipeline::latest()->get();
        return view('website.projects.projects-in-pipeline', compact('projectsInPipelines'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectsInPipelines = ProjectsInPipeline::latest()->get();
        return view('admin.projects.projects-in-pipeline', compact('projectsInPipelines'));
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
        ]);

        ProjectsInPipeline::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->back()->with('success', 'Project in pipeline added successfully');
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
        $projectsInPipeline = ProjectsInPipeline::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|numeric',
        ]);

        $projectsInPipeline->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->back()->with('success', 'Project in pipeline updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projectsInPipeline = ProjectsInPipeline::findOrFail($id);

        $projectsInPipeline->delete();

        return redirect()->back()->with('success', 'Project in pipeline deleted successfully');
    }
}
