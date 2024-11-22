<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryFile;
use Illuminate\Http\Request;

class GalleryFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the request
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id', // Ensure gallery exists
            'name' => 'required|string|max:255',
            'is_visible' => 'nullable|boolean',
            'downloadLink' => 'required|file',
        ]);

        // Find the gallery
        $gallery = Gallery::findOrFail($request->gallery_id);

        // Define the file path
        $year = now()->year;
        $directoryName = $gallery->event_name;

        // Ensure the directory exists (create it if necessary)
        $targetDirectory = public_path("admin-assets/Gallery/{$gallery->gallery_category}/{$directoryName}/{$year}");
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        if ($request->hasFile('downloadLink')) {
            // Generate a unique file name
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();

            // Move the file to the target directory
            $request->file('downloadLink')->move($targetDirectory, $fileName);

            // Set the full path for database storage
            $fullFilePath = "admin-assets/Gallery/{$gallery->gallery_category}/{$directoryName}/{$year}/{$fileName}";
        } else {
            return redirect()->back()->withErrors(['downloadLink' => 'File upload failed.']);
        }

        // Save the tender file in the database
        GalleryFile::create([
            'gallery_id' => $gallery->id,
            'name' => $request->name,
            'is_visible' => $request->boolean('is_visible'),
            'downloadLink' => $fullFilePath,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Gallery media added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryFile $galleryFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryFile $galleryFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryFile $galleryFile)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'is_visible' => 'nullable|boolean',
            'downloadLink' => 'nullable|file|max:10240', // Optional file upload
        ]);

        // If a new file is uploaded
        if ($request->hasFile('downloadLink')) {
            // Delete the old file
            if (file_exists(public_path($galleryFile->downloadLink))) {
                unlink(public_path($galleryFile->downloadLink));
            }

            // Define the new file path
            $gallery = $galleryFile->gallery;
            $year = now()->year;
            $directoryName = $gallery->event_name;

            $targetDirectory = public_path("admin-assets/Gallery/{$gallery->gallery_category}/{$directoryName}/{$year}");
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }

            // Generate a unique file name
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();

            // Move the file to the target directory
            $request->file('downloadLink')->move($targetDirectory, $fileName);

            // Set the full path for database storage
            $fullFilePath = "admin-assets/Gallery/{$gallery->gallery_category}/{$directoryName}/{$year}/{$fileName}";

            $galleryFile->downloadLink = $fullFilePath; // Update the file path
        }

        // Update the other fields
        $galleryFile->update([
            'name' => $request->name,
            'is_visible' => $request->boolean('is_visible'),
        ]);

        return redirect()->back()->with('success', 'Gallery media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryFile $galleryFile)
    {
        // Delete the file from storage
        if (file_exists(public_path($galleryFile->downloadLink))) {
            unlink(public_path($galleryFile->downloadLink));
        }

        // Delete the database record
        $galleryFile->delete();

        return redirect()->back()->with('success', 'Gallery media deleted successfully');
    }
}
