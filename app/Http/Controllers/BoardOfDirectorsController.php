<?php

namespace App\Http\Controllers;

use App\Models\BoardOfDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class BoardOfDirectorsController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $boardOfDirectors = BoardOfDirector::latest()->get();
        return view('website.about-us.board-of-directors', compact('boardOfDirectors'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boardOfDirectors = BoardOfDirector::latest()->get();
        return view('admin.about-us.board-of-directors', compact('boardOfDirectors'));
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
            'designation' => 'required|string',
            'organisation' => 'required|string',
            'downloadLink' => 'required|file',
            'is_chairman' => 'nullable|boolean',
            'is_md' => 'nullable|boolean',
            'is_gov_rep' => 'nullable|boolean',
            'is_indi_ditr' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/About Us/Board of Directors/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/About Us/Board of Directors/'), $fileName);
        }

        BoardOfDirector::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'organisation' => $request->organisation,
            'downloadLink' => $filePath,
            'is_chairman' => $request->boolean('is_chairman'),
            'is_md' => $request->boolean('is_md'),
            'is_gov_rep' => $request->boolean('is_gov_rep'),
            'is_indi_ditr' => $request->boolean('is_indi_ditr'),
        ]);

        return redirect()->back()->with('success', 'Board of Director added successfully');
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
        $boardOfDirector = BoardOfDirector::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'organisation' => 'required|string',
            'downloadLink' => 'nullable|file',
            'is_chairman' => 'nullable|boolean',
            'is_md' => 'nullable|boolean',
            'is_gov_rep' => 'nullable|boolean',
            'is_indi_ditr' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($boardOfDirector->downloadLink))) {
                File::delete(public_path($boardOfDirector->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/About Us/Board of Directors/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/About Us/Board of Directors/'), $fileName);
        } else {
            $filePath = $boardOfDirector->downloadLink;
        }

        $boardOfDirector->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'organisation' => $request->organisation,
            'downloadLink' => $filePath,
            'is_chairman' => $request->boolean('is_chairman'),
            'is_md' => $request->boolean('is_md'),
            'is_gov_rep' => $request->boolean('is_gov_rep'),
            'is_indi_ditr' => $request->boolean('is_indi_ditr'),
        ]);

        return redirect()->back()->with('success', 'Board of Director updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $boardOfDirector = BoardOfDirector::findOrFail($id);

        if (File::exists(public_path($boardOfDirector->downloadLink))) {
            // File::delete(public_path($boardOfDirector->downloadLink));
        }

        $boardOfDirector->delete();

        return redirect()->back()->with('success', 'Board of Director deleted successfully');
    }
}
