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
        if ($request->ajax()) {
            $data = DailyGeneration::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-warning edit-button" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                    // $btn .= ' <button class="btn btn-danger delete-button" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>';
                    return $btn;
                })
                ->editColumn('downloadLink', function ($row) {
                    return '<a href="' . asset('admin-assets/daily-generation/' . $row->downloadLink) . '" target="_blank"><i class="fa fa-file-pdf" style="color:red"></i> Download File</a>';
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->format('M d Y - h:i a'); // Format the date as needed
                })
                ->rawColumns(['action', 'downloadLink'])
                ->make(true);
        }

        $recordCount = DailyGeneration::count();
        return view('admin.daily-generation', compact('recordCount'));
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
            'description' => 'required|string|max:255',
            'downloadLink' => 'required|mimes:pdf|max:2048', // Validate for PDF and max 2MB size
        ]);

        // Handle file upload
        if ($request->hasFile('downloadLink')) {
            $file = $request->file('downloadLink');
            $filename = 'Daily Generation.pdf';
            $file->move(public_path('admin-assets/daily-generation'), $filename);

            DailyGeneration::create([
                'description' => $request->description,
                'downloadLink' => $filename,
            ]);

            return response()->json(['success' => 'Record added successfully.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dailyGeneration = DailyGeneration::find($id);
        return response()->json($dailyGeneration);
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
        $request->validate([
            'description' => 'required|string|max:255',
            'downloadLink' => 'nullable|mimes:pdf|max:2048', // Validate for PDF and max 2MB size
        ]);

        $dailyGeneration = DailyGeneration::findOrFail($id);

        if ($request->hasFile('downloadLink')) {
            // Delete the old file if it exists
            if (File::exists(public_path('admin-assets/daily-generation/' . $dailyGeneration->downloadLink))) {
                File::delete(public_path('admin-assets/daily-generation/' . $dailyGeneration->downloadLink));
            }

            $file = $request->file('downloadLink');
            $filename = 'Daily Generation.pdf';
            $file->move(public_path('admin-assets/daily-generation'), $filename);

            $dailyGeneration->downloadLink = $filename;
        }

        $dailyGeneration->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Record updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dailyGeneration = DailyGeneration::findOrFail($id);

        // Delete the file from storage
        if (File::exists(public_path('admin-assets/daily-generation/' . $dailyGeneration->downloadLink))) {
            File::delete(public_path('admin-assets/daily-generation/' . $dailyGeneration->downloadLink));
        }

        $dailyGeneration->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
