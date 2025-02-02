<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use Illuminate\Http\Request;

class EmployeeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeDetails = EmployeeDetail::latest()->get();
        $titles = EmployeeDetail::$title;
        return view('admin.employee-details', compact('employeeDetails', 'titles'));
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
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'nullable|date',
            'doj' => 'nullable|date',
            'dor' => 'nullable|date',
            'email_official' => 'nullable|email',
            'email_personal' => 'nullable|email',
            'phone' => 'nullable|string|regex:/^\+?[0-9\s\-]{7,15}$/'
        ]);

        EmployeeDetail::create([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'doj' => $request->doj,
            'dor' => $request->dor,
            'email_official' => $request->email_official,
            'email_personal' => $request->email_personal,
            'phone' => $request->phone,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeDetail $employeeDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeDetail $employeeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeDetail $employeeDetail)
    {
        $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'nullable|date',
            'doj' => 'nullable|date',
            'dor' => 'nullable|date',
            'email_official' => 'nullable|email',
            'email_personal' => 'nullable|email',
            'phone' => 'nullable|string|regex:/^\+?[0-9\s\-]{7,15}$/'
        ]);

        $employeeDetail->update([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'doj' => $request->doj,
            'dor' => $request->dor,
            'email_official' => $request->email_official,
            'email_personal' => $request->email_personal,
            'phone' => $request->phone,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Employee details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeDetail $employeeDetail)
    {
        $employeeDetail->deleted_by = auth()->id();
        $employeeDetail->save();

        $employeeDetail->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully');
    }
}
