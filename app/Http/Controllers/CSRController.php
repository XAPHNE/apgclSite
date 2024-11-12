<?php

namespace App\Http\Controllers;

use App\Models\CSR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class CSRController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $csrs = CSR::latest()->get();
        return view('website.corporate-social-responsibilites', compact('csrs'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $csrs = CSR::latest()->get();
        return view('admin.corporate-social-responsibility', compact('csrs'));
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
            $filePath = 'admin-assets/CSRs/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/CSRs/'), $fileName);
        }

        CSR::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'CSR added successfully');
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
        $csr = CSR::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($csr->downloadLink))) {
                File::delete(public_path($csr->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/CSRs/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/CSRs/'), $fileName);
        } else {
            $filePath = $csr->downloadLink;
        }

        $csr->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'CSR updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $csr = CSR::findOrFail($id);

        if (File::exists(public_path($csr->downloadLink))) {
            // File::delete(public_path($csr->downloadLink));
        }

        $csr->delete();

        return redirect()->back()->with('success', 'CSR deleted successfully');
    }
}
