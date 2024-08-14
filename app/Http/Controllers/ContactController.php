<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-warning edit-button" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                    $btn .= ' <button class="btn btn-danger delete-button" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.contacts');
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
            'location' => 'required|string|max:255',
            'priority' => 'required|integer',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
        ]);
    
        // Increment priorities of existing contacts with the same or higher priority
        Contact::where('priority', '>=', $request->priority)
            ->increment('priority');
    
        // Create the new contact
        Contact::create($request->all());
    
        return response()->json(['success' => 'Contact added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'priority' => 'required|integer',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
        ]);
    
        $contact = Contact::findOrFail($id);
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
    
        $contact->update($request->all());
    
        return response()->json(['success' => 'Contact updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::destroy($id);

        return response()->json(['success' => 'Contact deleted successfully.']);
    }
}
