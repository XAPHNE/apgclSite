<?php

namespace App\Http\Controllers;

use App\Models\CSR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class CSRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CSR::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-warning edit-button" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                    $btn .= ' <button class="btn btn-danger delete-button" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>';
                    return $btn;
                })
                ->editColumn('downloadLink', function ($row) {
                    return '<a href="' . asset('admin-assets/corporate-social-responsibility/' . $row->downloadLink) . '" target="_blank">Download File</a>';
                })
                ->rawColumns(['action', 'downloadLink'])
                ->make(true);
        }

        return view('admin.corporate-social-responsibility');
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
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin-assets/corporate-social-responsibility'), $filename);

            CSR::create([
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
        $csr = CSR::find($id);
        return response()->json($csr);
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

        $csr = CSR::findOrFail($id);

        if ($request->hasFile('downloadLink')) {
            // Delete the old file if it exists
            if (File::exists(public_path('admin-assets/corporate-social-responsibility/' . $csr->downloadLink))) {
                File::delete(public_path('admin-assets/corporate-social-responsibility/' . $csr->downloadLink));
            }

            $file = $request->file('downloadLink');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin-assets/corporate-social-responsibility'), $filename);

            $csr->downloadLink = $filename;
        }

        $csr->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Record updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $csr = CSR::findOrFail($id);

        // Delete the file from storage
        if (File::exists(public_path('admin-assets/corporate-social-responsibility/' . $csr->downloadLink))) {
            File::delete(public_path('admin-assets/corporate-social-responsibility/' . $csr->downloadLink));
        }

        $csr->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
