<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TenderController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $tenders = Tender::with('tenderFiles')
            ->where('is_archived', false)
            ->latest()
            ->get();
        return view('website.tenders.current-financial-year', compact('tenders'));
    }

    public function archivedTenders(Request $request, $lang)
    {
        App::setLocale($lang);
        $tenders = Tender::with('tenderFiles')
            ->where('is_archived', true)
            ->latest()
            ->get();
        return view('website.tenders.archive', compact('tenders'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $financialYears = FinancialYear::latest()->get();
        $tenders = Tender::with('tenderFiles')->latest()->get();
        return view('admin.tenders', compact('tenders', 'financialYears'));
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
            'tender_no' => 'required|string',
            'description' => 'required|string',
            'is_archived' => 'nullable|boolean',
            'financial_year_id' => 'required|exists:financial_years,id',
        ]);

        $tender = Tender::create([
            'tender_no' => $request->tender_no,
            'description' => $request->description,
            'financial_year_id' => $request->financial_year_id,
            'is_archived' => false,
        ]);

        return redirect()->route('tenders.show', $tender->id)->with('success', 'Tender added successfully');
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
        $tender = Tender::findOrFail($id);

        $request->validate([
            'tender_no' => 'required|string',
            'description' => 'required|string',
            'is_archived' => 'nullable|boolean',
            'financial_year_id' => 'required|exists:financial_years,id',
        ]);

        $tender->update(['tender_no' => $request->tender_no,
            'description' => $request->description,
            'financial_year_id' => $request->financial_year_id,
            'is_archived' => $request->boolean('is_archived'),
        ]);

        return redirect()->back()->with('success', 'Tender updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tender = Tender::findOrFail($id);

        if (File::exists(public_path($tender->downloadLink))) {
            // File::delete(public_path($tender->downloadLink));
        }

        $tender->delete();

        return redirect()->back()->with('success', 'Tender deleted successfully');
    }
}
