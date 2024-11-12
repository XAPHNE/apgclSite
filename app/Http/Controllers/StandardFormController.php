<?php

namespace App\Http\Controllers;

use App\Models\StandardForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StandardFormController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $standardForms = StandardForm::latest()->get();
        return view('website.documents.standardForms', compact('standardForms'));
    }
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
            $filePath = 'admin-assets/Documents/Standard Forms/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Standard Forms/'), $fileName);
        }

        StandardForm::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Standard form added successfully');
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
        $standardForm = StandardForm::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($standardForm->downloadLink))) {
                File::delete(public_path($standardForm->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Standard Forms/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Standard Forms/'), $fileName);
        } else {
            $filePath = $standardForm->downloadLink;
        }

        $standardForm->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Standard Form updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $standardForm = StandardForm::findOrFail($id);

        if (File::exists(public_path($standardForm->downloadLink))) {
            // File::delete(public_path($standardForm->downloadLink));
        }

        $standardForm->delete();

        return redirect()->back()->with('success', 'Standard form deleted successfully');
    }
}
