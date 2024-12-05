<?php

namespace App\Http\Controllers;

use App\Models\ServiceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $serviceRules = ServiceRule::latest()->get();
        return view('admin.documents.service-rule', compact('serviceRules'));
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
            $filePath = 'admin-assets/Documents/Service Rules/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Service Rules/'), $fileName);
        }

        ServiceRule::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Service rule added successfully');
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
        $serviceRule = ServiceRule::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($serviceRule->downloadLink))) {
                File::delete(public_path($serviceRule->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Service Rules/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Service Rules/'), $fileName);
        } else {
            $filePath = $serviceRule->downloadLink;
        }

        $serviceRule->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Service rule updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceRule = ServiceRule::findOrFail($id);

        if (File::exists(public_path($serviceRule->downloadLink))) {
            // File::delete(public_path($serviceRule->downloadLink));
        }

        $serviceRule->deleted_by = auth()->id();
        $serviceRule->save();

        $serviceRule->delete();

        return redirect()->back()->with('success', 'Service rule deleted successfully');
    }
}
