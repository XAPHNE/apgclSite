<?php

namespace App\Http\Controllers;

use App\Models\AnnualStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class AnnualStatementController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $annualStatements = AnnualStatement::latest()->get();
        return view('website.documents.annual-statements', compact('annualStatements'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $annualStatements = AnnualStatement::latest()->get();
        return view('admin.documents.annual-statement', compact('annualStatements'));
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

        AnnualStatement::create([
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
        $annualStatement = AnnualStatement::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($annualStatement->downloadLink))) {
                File::delete(public_path($annualStatement->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Annual Returns/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Annual Returns/'), $fileName);
        } else {
            $filePath = $annualStatement->downloadLink;
        }

        $annualStatement->update([
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
        $annualStatement = AnnualStatement::findOrFail($id);

        if (File::exists(public_path($annualStatement->downloadLink))) {
            File::delete(public_path($annualStatement->downloadLink));
        }

        $annualStatement->delete();

        return redirect()->back()->with('success', 'Standard form deleted successfully');
    }
}
