<?php

namespace App\Http\Controllers;

use App\Models\TariffPetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TariffPetitionController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $tariffPetitions = TariffPetition::latest()->get();
        return view('website.documents.tariff-petition', compact('tariffPetitions'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tariffPetitions = TariffPetition::latest()->get();
        return view('admin.documents.tariff-petition', compact('tariffPetitions'));
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
            $filePath = 'admin-assets/Documents/Tariffs/Tariff Petition/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Tariffs/Tariff Petitions/'), $fileName);
        }

        TariffPetition::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Tariff petition added successfully');
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
        $tariffPetition = TariffPetition::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($tariffPetition->downloadLink))) {
                File::delete(public_path($tariffPetition->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Tariffs/Tariff Petitions/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Tariffs/Tariff Petitions/'), $fileName);
        } else {
            $filePath = $tariffPetition->downloadLink;
        }

        $tariffPetition->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Tariff petition updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tariffPetition = TariffPetition::findOrFail($id);

        if (File::exists(public_path($tariffPetition->downloadLink))) {
            // File::delete(public_path($tariffPetition->downloadLink));
        }

        $tariffPetition->delete();

        return redirect()->back()->with('success', 'Tariff petition deleted successfully');
    }
}
