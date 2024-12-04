<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $financialYears = FinancialYear::latest()->get();
        return view('admin.tenders.financial-years', compact('financialYears'));
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
            'year' => [
            'required',
            'string',
            'max:9',
            'regex:/^\d{4}-\d{4}$/',
            Rule::unique('financial_years', 'year'),
        ],
        ]);
    
        FinancialYear::create([
            'year' => $request->year,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Financial Year added successfully');
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
        $financialYear = FinancialYear::findOrFail($id);

        $request->validate([
            'year' => [
            'required',
            'string',
            'max:9',
            'regex:/^\d{4}-\d{4}$/',
            Rule::unique('financial_years', 'year'),
        ],
        ]);

        $financialYear->update([
            'year' => $request->year,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Financial Year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $financialYear = FinancialYear::findOrFail($id);

        $financialYear->deleted_by = auth()->id();
        $financialYear->save();

        $financialYear->delete();

        return redirect()->back()->with('success', 'Financial Year deleted successfully');
    }
}
