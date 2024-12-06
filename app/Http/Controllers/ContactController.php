<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $contacts = Contact::orderBy('priority')->get();
        return view('website.contact-us', compact('contacts'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = Contact::orderBy('priority')->get();
        $officeCategories = Contact::officeCategories();
        return view('admin.contact-us', compact('contacts', 'officeCategories'));
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
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'priority' => 'required|integer',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'is_office_bearer' => 'nullable|boolean',
            'office_category' => 'nullable|string|max:255',
            'office_name' => 'nullable|string|max:255',
            'office_address' => 'nullable|string|max:255',
        ]);
    
        // Increment priorities of existing contacts with the same or higher priority
        Contact::where('priority', '>=', $request->priority)
            ->increment('priority');
    
        // Create the new contact
        Contact::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'priority' => $request->priority,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_office_bearer' => $request->boolean('is_office_bearer'),
            'office_category' => $request->input('office_category'),
            'office_name' => $request->office_name,
            'office_address' => $request->office_address,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'Contact added successfully');
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
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'priority' => 'required|integer',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'is_office_bearer' => 'nullable|boolean',
            'office_category' => 'nullable|string|max:255',
            'office_name' => 'nullable|string|max:255',
            'office_address' => 'nullable|string|max:255',
        ]);
    
        
        $oldPriority = $contact->priority;
        $newPriority = $request->priority;
    
        if ($newPriority != $oldPriority) {
            if ($newPriority < $oldPriority) {
                // If the new priority is higher (i.e., smaller number) than the old one,
                // we need to increment priorities between the new and old priority
                Contact::whereBetween('priority', [$newPriority, $oldPriority - 1])
                    ->increment('priority');
            } else {
                // If the new priority is lower (i.e., larger number) than the old one,
                // we need to decrement priorities between the old and new priority
                Contact::whereBetween('priority', [$oldPriority + 1, $newPriority])
                    ->decrement('priority');
            }
        }
    
        $contact->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'priority' => $request->priority,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_office_bearer' => $request->boolean('is_office_bearer'),
            'office_category' => $request->input('office_category'),
            'office_name' => $request->office_name,
            'office_address' => $request->office_address,
            'updated_by' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->deleted_by = auth()->id();
        $contact->save();

        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}
