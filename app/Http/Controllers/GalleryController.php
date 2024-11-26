<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GalleryController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $galleries = Gallery::where('is_visible', true)->latest()->get();
        $galleryCategories = array_filter(Gallery::$galleryCategory, function ($galleryCategories) {
            return $galleryCategories !== 'Home Page Slider';
        });
        return view('website.about-us.gallery', compact('galleries', 'galleryCategories'));
    }
    public function websiteShow($lang, Gallery $gallery)
    {
        App::setLocale($lang);
        $galleryFiles = $gallery->galleryFiles;

        return view('website.about-us.gallery.view-gallery', compact('gallery', 'galleryFiles'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $galleryCategories = Gallery::$galleryCategory;
        return view('admin.gallery', compact('galleries', 'galleryCategories'));
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
            'gallery_category' => 'required|string',
            'event_name' => 'required|string',
            'event_description' => 'required|string',
            'thumbnail' => 'required|file',
            'is_visible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_thumbnail_' . $request->file('thumbnail')->getClientOriginalName();
            $filePath = 'admin-assets/Gallery/' . $request->gallery_category . '/' . ucwords($request->event_name) . '/' . $fileName;
            $request->file('thumbnail')->move(public_path('admin-assets/Gallery/' . $request->gallery_category . '/' . ucwords($request->event_name) . '/'), $fileName);
        }

        Gallery::create([
            'gallery_category' => $request->gallery_category,
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'thumbnail' => $filePath,
            'is_visible' => $request->boolean('is_visible'),
        ]);

        return redirect()->back()->with('success', 'Gallery added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('galleryFiles'); // Load related gallery files
        $galleryFiles = $gallery->galleryFiles; // Access the related files

        return view('admin.gallery.gallery-images', compact('gallery', 'galleryFiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Validate the request
        $request->validate([
            'event_description' => 'required|string',
            'thumbnail' => 'nullable|file', // Thumbnail is optional during update
            'is_visible' => 'nullable|boolean',
        ]);

        // Initialize file path with the existing thumbnail
        $filePath = $gallery->thumbnail;

        // Handle file upload if a new file is provided
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail if it exists
            if (file_exists(public_path($gallery->thumbnail))) {
                unlink(public_path($gallery->thumbnail));
            }

            // Save the new thumbnail
            $fileName = time() . '_thumbnail_' . $request->file('thumbnail')->getClientOriginalName();
            $filePath = 'admin-assets/Gallery/' . $request->gallery_category . '/' . ucwords($request->event_name) . '/' . $fileName;
            $request->file('thumbnail')->move(public_path('admin-assets/Gallery/' . $request->gallery_category . '/' . ucwords($request->event_name) . '/'), $fileName);
        }

        // Update the gallery record
        $gallery->update([
            'event_description' => $request->event_description,
            'thumbnail' => $filePath,
            'is_visible' => $request->boolean('is_visible'),
        ]);

        return redirect()->back()->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Check if the thumbnail file exists and delete it
        if ($gallery->thumbnail && file_exists(public_path($gallery->thumbnail))) {
            // unlink(public_path($gallery->thumbnail));
        }

        // Delete the gallery record
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery deleted successfully');
    }
}
