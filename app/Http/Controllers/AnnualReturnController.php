<?php

namespace App\Http\Controllers;

use App\Models\AnnualReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class AnnualReturnController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $annualReturns = AnnualReturn::latest()->get();
        return view('website.documents.annual-returns', compact('annualReturns'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $annualReturns = AnnualReturn::latest()->get();
        return view('admin.documents.annual-return', compact('annualReturns'));
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
            $filePath = 'admin-assets/Documents/Annual Returns/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Annual Returns/'), $fileName);
        }

        AnnualReturn::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Annual return added successfully');
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
        $annualReturn = AnnualReturn::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($annualReturn->downloadLink))) {
                File::delete(public_path($annualReturn->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Annual Returns/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Annual Returns/'), $fileName);
        } else {
            $filePath = $annualReturn->downloadLink;
        }

        $annualReturn->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Annual return updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annualReturn = AnnualReturn::findOrFail($id);

        if (File::exists(public_path($annualReturn->downloadLink))) {
            // File::delete(public_path($annualReturn->downloadLink));
        }

        $annualReturn->delete();

        return redirect()->back()->with('success', 'Annual return deleted successfully');
    }
}
