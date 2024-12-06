<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class CalendarController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $calendars = Calendar::latest()->get();
        return view('website.calendars', compact('calendars'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $calendars = Calendar::latest()->get();
        return view('admin.calendar', compact('calendars'));
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
            $filePath = 'admin-assets/Calendars/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Calendars/'), $fileName);
        }

        Calendar::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Calendar added successfully');
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
        $calendar = Calendar::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($calendar->downloadLink))) {
                File::delete(public_path($calendar->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Calendars/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Calendars/'), $fileName);
        } else {
            $filePath = $calendar->downloadLink;
        }

        $calendar->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Calendar updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $calendar = Calendar::findOrFail($id);

        if (File::exists(public_path($calendar->downloadLink))) {
            // File::delete(public_path($calendar->downloadLink));
        }

        $calendar->deleted_by = auth()->id();
        $calendar->save();

        $calendar->delete();

        return redirect()->back()->with('success', 'Calendar deleted successfully');
    }
}
