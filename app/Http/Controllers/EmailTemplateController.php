<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Event;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emailTemplates = EmailTemplate::with('event')->latest()->get();
        $events = Event::latest()->get();
        return view('admin.email-templates', compact('emailTemplates', 'events'));
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
            'subject' => 'required|string',
            'email_body' => 'required|string',
            'signature' => 'required|string',
            'is_birthday' => 'nullable|boolean',
            'is_joining_aniversery' => 'nullable|boolean',
            'is_retirement' => 'nullable|boolean',
            'is_holiday' => 'nullable|boolean',
            'event_id' => 'nullable|integer|exists:events,id'
        ]);

        try {
            EmailTemplate::create([
                'subject' => $request->subject,
                'email_body' => $request->email_body,
                'signature' => $request->signature,
                'is_birthday' => $request->boolean('is_birthday'),
                'is_joining_aniversery' => $request->boolean('is_joining_aniversery'),
                'is_retirement' => $request->boolean('is_retirement'),
                'is_holiday' => $request->boolean('is_holiday', false),
                'event_id' => $request->event_id,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);
    
            return redirect()->back()->with('success', 'Email Template added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the Email Template.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $request->validate([
            'subject' => 'required|string',
            'email_body' => 'required|string',
            'signature' => 'required|string',
            'is_birthday' => 'nullable|boolean',
            'is_joining_aniversery' => 'nullable|boolean',
            'is_retirement' => 'nullable|boolean',
            'is_holiday' => 'nullable|boolean',
            'event_id' => 'nullable|integer|exists:events,id'
        ]);

        try {
            $eventId = $request->boolean('is_holiday') ? $request->event_id : null;
            $emailTemplate->update([
                'subject' => $request->subject,
                'email_body' => $request->email_body,
                'signature' => $request->signature,
                'is_birthday' => $request->boolean('is_birthday'),
                'is_joining_aniversery' => $request->boolean('is_joining_aniversery'),
                'is_retirement' => $request->boolean('is_retirement'),
                'is_holiday' => $request->boolean('is_holiday', false),
                'event_id' => $eventId,
                'updated_by' => auth()->id()
            ]);

            return redirect()->back()->with('success', 'Email Template updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the Email Template.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        try {
            $emailTemplate->update(['deleted_by' => auth()->id()]);
            $emailTemplate->deleteOrFail();

            return redirect()->back()->with('success', 'Email Template deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Email Template.');
        }
    }
}
