<?php

namespace App\Http\Controllers;

use App\Models\AnnualReturn;
use App\Models\AnnualStatement;
use App\Models\Publication;
use App\Models\Report;
use App\Models\RightToInformation;
use App\Models\StandardForm;
use App\Models\TariffPetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WebsiteHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lang = null)
    {
        if (!$lang) {
            $lang = config('app.fallback_locale');
        }
        App::setLocale($lang);

        $tariffPetition = TariffPetition::latest()->get();
        $rtis = RightToInformation::latest()->get();
        $annualStatements = AnnualStatement::latest()->get();
        $annualReturns = AnnualReturn::latest()->get();
        $reports = Report::latest()->get();
        $publications = Publication::latest()->get();
        $standardForms = StandardForm::latest()->get();

        // Merge and sort by creation date
        $latestEntries = collect($tariffPetition)
            ->merge($rtis)
            ->merge($annualStatements)
            ->merge($annualReturns)
            ->merge($reports)
            ->merge($publications)
            ->merge($standardForms)
            ->sortByDesc('created_at')
            ->values();

        return view('welcome', compact('latestEntries'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
