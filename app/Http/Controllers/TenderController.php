<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use App\Models\Tender;
use App\Models\TenderFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TenderController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $financialYear = FinancialYear::latest()->first();
        $tenders = Tender::with('tenderFiles')
            ->where('financial_year_id', $financialYear->id)
            ->latest()
            ->get();
        return view('website.tenders.current-financial-year', compact('tenders', 'financialYear'));
    }

    public function archivedTenders(Request $request, $lang)
    {
        App::setLocale($lang);

        // Get the latest financial year and exclude it
        $latestFinancialYear = FinancialYear::latest()->first();
        $financialYears = FinancialYear::where('id', '!=', optional($latestFinancialYear)->id)->latest()->get();

        // Determine the selected financial year or default to the first available one
        $selectedFinancialYearId = $request->query('financial_year_id', $financialYears->first()->id ?? null);

        // If no financial year is selected and none exist, handle gracefully
        if (!$selectedFinancialYearId) {
            return view('website.tenders.archive', [
                'tenders' => collect(), // Empty collection for tenders
                'financialYears' => $financialYears, // May still be empty
                'selectedFinancialYearId' => null,
            ])->with('error', 'No archived financial years found.');
        }

        // Fetch archived tenders for the selected financial year
        $tenders = Tender::with('tenderFiles')
            ->where('is_archived', true)
            ->where('financial_year_id', $selectedFinancialYearId)
            ->latest()
            ->get();

        // For AJAX requests, return only the table rows
        if ($request->ajax()) {
            $html = view('website.tenders.partials.archived-tenders', compact('tenders'))->render();
            return response()->json(['html' => $html]);
        }

        // For normal requests, return the full view
        return view('website.tenders.archive', compact('tenders', 'financialYears', 'selectedFinancialYearId'));
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
            'directory_name' => 'required|string',
            'financial_year_id' => 'required|exists:financial_years,id',
        ]);

        $tender = Tender::create([
            'tender_no' => $request->tender_no,
            'description' => strtoupper($request->description),
            'financial_year_id' => $request->financial_year_id,
            'is_archived' => false,
            'directory_name' => ucwords($request->directory_name),
        ]);

        return redirect()->route('tenders.show', $tender->id)->with('success', 'Tender added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $financialYears = FinancialYear::latest()->get();
        $tender = Tender::findOrFail($id);
        $tenderFiles = TenderFile::where('tender_id', $id)->latest()->get();

        return view('admin.tenders.tender-details', compact('tender', 'tenderFiles', 'financialYears'));
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
            'directory_name' => 'required|string',
            'financial_year_id' => 'required|exists:financial_years,id',
        ]);

        $tender->update([
            'tender_no' => $request->tender_no,
            'description' => strtoupper($request->description),
            'financial_year_id' => $request->financial_year_id,
            'is_archived' => $request->boolean('is_archived'),
            'directory_name' => ucwords($request->directory_name),
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
