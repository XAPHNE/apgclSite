<?php

namespace App\Http\Controllers;

use App\Models\StandardForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StandardFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $standardForms = StandardForm::latest()->get();
        return view('admin.documents.standard-form', compact('standardForms'));
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
        $validator = Validator::make($request->all(),[

            'description' => 'required',
            'downloadLink' => 'required'

        ]);

        if($request->hasFile('downloadLink')) {
            $standardFormFileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Document/Standard/' . $standardFormFileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Document/Standard/'), $standardFormFileName);
        }

        $standardForm = StandardForm::create([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->visibility ?? false,
            'news_n_events' => $request->newsNEvents ?? false,
            'new_badge' => $request->newBadge ?? false,
        ]);

        if ($standardForm) {
            return redirect()->back()->with('success', 'Standard form added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add standard form');
        }
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
        $request->validate([
            'description' => 'required|string',
            'downloadLink' => 'required|file',
        ]);

        $standardForm = StandardForm::findOrFail($id);

        // Handle file update
        if ($request->hasFile('downloadLink')) {
            // Delete the old file if it exists
            if (File::exists(public_path($standardForm->downloadLink))) {
                File::delete(public_path($standardForm->downloadLink));
            }

            // Upload the new file
            $standardFormFileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Document/Standard/' . $standardFormFileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Document/Standard/'), $standardFormFileName);
        } else {
            // If no new file is uploaded, retain the existing file path
            $filePath = $standardForm->downloadLink;
        }

        // Update the invoice
        $standardForm->update([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->visibility ?? false,
            'news_n_events' => $request->newsNEvents ?? false,
            'new_badge' => $request->newBadge ?? false,
        ]);

        return redirect()->back()->with('success', 'Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $standard = StandardForm::find($id);
        $file = StandardForm::where('id', $id)->pluck('downloadLink')->first();
        unlink(public_path($file));
        $standard->delete();
    }
}
