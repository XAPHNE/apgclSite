<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class RecruitmentController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $recruitments = Recruitment::latest()->get();
        return view('website.career.recruitments', compact('recruitments'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recruitments = Recruitment::latest()->get();
        return view('admin.career.recruitment', compact('recruitments'));
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
            $filePath = 'admin-assets/Career/Recruitments/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Career/Recruitments/'), $fileName);
        }

        Recruitment::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Recruitment added successfully');
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
        $recruitment = Recruitment::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($recruitment->downloadLink))) {
                File::delete(public_path($recruitment->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Career/Recruitments/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Career/Recruitments/'), $fileName);
        } else {
            $filePath = $recruitment->downloadLink;
        }

        $recruitment->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Recruitment updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recruitment = Recruitment::findOrFail($id);

        if (File::exists(public_path($recruitment->downloadLink))) {
            // File::delete(public_path($recruitment->downloadLink));
        }

        $recruitment->delete();

        return redirect()->back()->with('success', 'Recruitment deleted successfully');
    }
}
