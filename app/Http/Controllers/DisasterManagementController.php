<?php

namespace App\Http\Controllers;

use App\Models\DisasterManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class DisasterManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DisasterManagement::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-warning edit-button" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                    $btn .= ' <button class="btn btn-danger delete-button" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>';
                    return $btn;
                })
                ->editColumn('fileLink', function ($row) {
                    return '<a href="' . asset('admin-assets/disaster-management/' . $row->fileLink) . '" target="_blank">View File</a>';
                })
                ->rawColumns(['action', 'fileLink'])
                ->make(true);
        }

        return view('admin.disaster-management');
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
            'fileLink' => 'required|mimes:pdf|max:2048', // Validate for PDF and max 2MB size
        ]);

        // Handle file upload
        if ($request->hasFile('fileLink')) {
            $file = $request->file('fileLink');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin-assets/disaster-management'), $filename);

            DisasterManagement::create([
                'description' => $request->description,
                'fileName' => $file->getClientOriginalName(),
                'fileLink' => $filename,
            ]);

            return response()->json(['success' => 'Record added successfully.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disaster = DisasterManagement::find($id);
        return response()->json($disaster);
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
            'fileLink' => 'nullable|mimes:pdf|max:2048', // Validate for PDF and max 2MB size
        ]);

        $disaster = DisasterManagement::findOrFail($id);

        if ($request->hasFile('fileLink')) {
            // Delete the old file if it exists
            if (File::exists(public_path('admin-assets/disaster-management/' . $disaster->fileLink))) {
                File::delete(public_path('admin-assets/disaster-management/' . $disaster->fileLink));
            }

            $file = $request->file('fileLink');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin-assets/disaster-management'), $filename);

            $disaster->fileLink = $filename;
            $disaster->fileName = $file->getClientOriginalName();
        }

        $disaster->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Record updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disaster = DisasterManagement::findOrFail($id);

        // Delete the file from storage
        if (File::exists(public_path('admin-assets/disaster-management/' . $disaster->fileLink))) {
            File::delete(public_path('admin-assets/disaster-management/' . $disaster->fileLink));
        }

        $disaster->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
