<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emailTemplates = EmailTemplate::latest()->get();
        return view('admin.email-tempplates', compact('emailTemplates'));
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
            'signature' => 'required|string'
        ]);

        EmailTemplate::create([
            'subject' => $request->subject,
            'email_body' => $request->email_body,
            'signature' => $request->signature,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Email Template added successfully');
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
            'signature' => 'required|string'
        ]);

        $emailTemplate->update([
            'subject' => $request->subject,
            'email_body' => $request->email_body,
            'signature' => $request->signature,
            'updated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Email Template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->deleted_by = auth()->id();
        $emailTemplate->save();

        $emailTemplate->delete();

        return redirect()->back()->with('success', 'Email Template deleted successfully');
    }
}
