<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use App\Models\Tender;
use App\Models\TenderFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TenderController extends Controller
{
    public function tenderForReview()
    {
        $financialYears = FinancialYear::latest()->get();
        $departments = User::$departments;

        // Check if the authenticated user has the 'Super Admin' role
        if (auth()->user()->hasRole('Super Admin')) {
            // If the user is a Super Admin, fetch all tenders
            $tenders = Tender::with('tenderFiles')
                ->where('for_review', true)
                ->latest()
                ->get();
        } else {
            // Otherwise, filter tenders by the authenticated user's department
            $tenders = Tender::with('tenderFiles')
                ->where('department', auth()->user()->department)
                ->where('for_review', true)
                ->latest()
                ->get();
        }
        return view('admin.tenders.for-review', compact('tenders', 'financialYears', 'departments'));
    }

    public function approve($id)
    {
        $tender = Tender::findOrFail($id);

        if (!auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Unauthorized action.');
        }

        $tender->update([
            'for_review' => false,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Tender approved and published successfully.');
    }

    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $tenders = Tender::with('tenderFiles')
            ->where('is_archived', false)
            ->where('for_review', false)
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
            ->where('for_review', false)
            ->where('financial_year_id', $selectedFinancialYearId)
            ->latest()
            ->get();

        // If no tenders are found, pass an empty collection
        if ($tenders->isEmpty()) {
            return view('website.tenders.archive', [
                'tenders' => collect(), // Empty collection for tenders
                'financialYears' => $financialYears,
                'selectedFinancialYearId' => $selectedFinancialYearId,
            ])->with('warning', 'No tenders found for the selected financial year.');
        }
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
        $departments = User::$departments;

        // Check if the authenticated user has the 'Super Admin' role
        if (auth()->user()->hasRole('Super Admin')) {
            // If the user is a Super Admin, fetch all tenders
            $tenders = Tender::with('tenderFiles')
                ->where('for_review', false)
                ->latest()->get();
        } else {
            // Otherwise, filter tenders by the authenticated user's department
            $tenders = Tender::with('tenderFiles')
                ->where('department', auth()->user()->department)
                ->where('for_review', false)
                ->latest()
                ->get();
        }

        return view('admin.tenders', compact('tenders', 'financialYears', 'departments'));
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
            'department' => 'required|string|in:' . implode(',', User::$departments),
            'tender_no' => 'required|string',
            'description' => 'required|string',
            'is_archived' => 'nullable|boolean',
            'directory_name' => 'required|string',
            'financial_year_id' => 'required|exists:financial_years,id',
        ]);

        $department = auth()->user()->hasRole('Super Admin') ? $request->department : auth()->user()->department;

        $tender = Tender::create([
            'department' => $department,
            'tender_no' => $request->tender_no,
            'description' => strtoupper($request->description),
            'financial_year_id' => $request->financial_year_id,
            'is_archived' => false,
            'for_review' => auth()->user()->hasRole('Tender Uploader') && !auth()->user()->can('Skip Tender Review'), // Set for_review to true if user is Tender Uploader
            'directory_name' => ucwords(strtolower(preg_replace('/\s+/', ' ', trim($request->directory_name)))),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
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
        $departments = User::$departments;

        return view('admin.tenders.tender-details', compact('tender', 'tenderFiles', 'financialYears', 'departments'));
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
            'department' => 'required|string|in:' . implode(',', User::$departments),
            'tender_no' => 'required|string',
            'description' => 'required|string',
            'is_archived' => 'nullable|boolean',
        ]);

        $tender->update([
            'department' => $request->department,
            'tender_no' => $request->tender_no,
            'description' => strtoupper($request->description),
            'is_archived' => $request->boolean('is_archived'),
            'updated_by' => auth()->id(),
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

        $tender->deleted_by = auth()->id();
        $tender->save();

        $tender->delete();

        return redirect()->back()->with('success', 'Tender deleted successfully');
    }
}
