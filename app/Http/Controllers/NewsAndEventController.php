<?php

namespace App\Http\Controllers;

use App\Models\NewsAndEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class NewsAndEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newsAndEvents = NewsAndEvent::latest()->get();
        return view('admin.news-and-event', compact('newsAndEvents'));
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
            'description' => 'required|string',
            'downloadLink' => 'required|file',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/News and Events/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/News and Events/'), $fileName);
        }

        NewsAndEvent::create([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'News and Event item added successfully');
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
        $newsAndEvent = NewsAndEvent::findOrFail($id);

        $request->validate([
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($newsAndEvent->downloadLink))) {
                File::delete(public_path($newsAndEvent->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/News and Events/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/News and Events/'), $fileName);
        } else {
            $filePath = $newsAndEvent->downloadLink;
        }

        $newsAndEvent->update([
            'description' => $request->description,
            'downloadLink' => $filePath,
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'News and Event item updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsAndEvent = NewsAndEvent::findOrFail($id);

        if (File::exists(public_path($newsAndEvent->downloadLink))) {
            File::delete(public_path($newsAndEvent->downloadLink));
        }

        $newsAndEvent->delete();

        return redirect()->back()->with('success', 'News and Event item deleted successfully');
    }
}
