<?php

namespace App\Http\Controllers;

use App\Models\DailyGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class DailyGenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dailyGenerations = DailyGeneration::latest()->get();
        return view('admin.daily-generation', compact('dailyGenerations'));
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
            'description' => 'required|string',
            'downloadLink' => 'required|file',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Daily Generation/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Daily Generation/'), $fileName);
        }

        DailyGeneration::create([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Daily Generation added successfully');
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
        $dailyGeneration = DailyGeneration::findOrFail($id);

        $request->validate([
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($dailyGeneration->downloadLink))) {
                File::delete(public_path($dailyGeneration->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Daily Generation/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Daily Generation/'), $fileName);
        } else {
            $filePath = $dailyGeneration->downloadLink;
        }

        $dailyGeneration->update([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Daily Generation updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dailyGeneration = DailyGeneration::findOrFail($id);

        if (File::exists(public_path($dailyGeneration->downloadLink))) {
            // File::delete(public_path($dailyGeneration->downloadLink));
        }

        $dailyGeneration->deleted_by = auth()->id();
        $dailyGeneration->save();

        $dailyGeneration->delete();

        return redirect()->back()->with('success', 'Daily Generation deleted successfully');
    }
}
