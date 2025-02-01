<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        $months = Event::$month;
        $days = Event::$day;
        return view('admin.events', compact('events', 'months', 'days'));
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
            'month' => 'required|string',
            'date' => 'required|date',
            'day' => 'required|string',
            'public_holidays' => 'required|string',
        ]);

        Event::create([
            'month' => $request->month,
            'date' => $request->date,
            'day' => $request->day,
            'public_holidays' => $request->public_holidays,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Event added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'month' => 'required|string',
            'date' => 'required|date',
            'day' => 'required|string',
            'public_holidays' => 'required|string',
        ]);

        $event->update([
            'month' => $request->month,
            'date' => $request->date,
            'day' => $request->day,
            'public_holidays' => $request->public_holidays,
            'updated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->deleted_by = auth()->id();
        $event->save();

        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully');
    }
}
