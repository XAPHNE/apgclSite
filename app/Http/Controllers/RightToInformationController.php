<?php

namespace App\Http\Controllers;

use App\Models\RightToInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class RightToInformationController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $rtis = RightToInformation::latest()->get();
        return view('website.documents.rti', compact('rtis'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rtis = RightToInformation::latest()->get();
        return view('admin.documents.right-to-information', compact('rtis'));
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
            $filePath = 'admin-assets/Documents/RTIs/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/RTIs/'), $fileName);
        }

        RightToInformation::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'RTI added successfully');
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
        $rti = RightToInformation::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($rti->downloadLink))) {
                File::delete(public_path($rti->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/RTIs/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/RTIs/'), $fileName);
        } else {
            $filePath = $rti->downloadLink;
        }

        $rti->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'RTI updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rti = RightToInformation::findOrFail($id);

        if (File::exists(public_path($rti->downloadLink))) {
            File::delete(public_path($rti->downloadLink));
        }

        $rti->delete();

        return redirect()->back()->with('success', 'RTI deleted successfully');
    }
}
