<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\AnnualReturn;
use App\Models\AnnualStatement;
use App\Models\Calendar;
use App\Models\Certificate;
use App\Models\CSR;
use App\Models\DisasterManagement;
use App\Models\NewsAndEvent;
use App\Models\Policy;
use App\Models\Publication;
use App\Models\Report;
use App\Models\RightToInformation;
use App\Models\Roster;
use App\Models\ServiceRule;
use App\Models\StandardForm;
use App\Models\TariffOrder;
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

        $newsAndEvents = NewsAndEvent::latest()->get();
        $rosters = Roster::latest()->get();
        $acts = Act::latest()->get();
        $policies = Policy::latest()->get();
        $serviceRules = ServiceRule::latest()->get();
        $certificates = Certificate::latest()->get();
        $tariffOrders = TariffOrder::latest()->get();
        $tariffPetition = TariffPetition::latest()->get();
        $rtis = RightToInformation::latest()->get();
        $annualStatements = AnnualStatement::latest()->get();
        $annualReturns = AnnualReturn::latest()->get();
        $reports = Report::latest()->get();
        $publications = Publication::latest()->get();
        $standardForms = StandardForm::latest()->get();
        $csrs = CSR::latest()->get();
        $calendars = Calendar::latest()->get();
        $disasterManagements = DisasterManagement::latest()->get();

        // Merge and sort by creation date
        $latestEntries = collect($newsAndEvents)
            ->merge($rosters)
            ->merge($acts)
            ->merge($policies)
            ->merge($serviceRules)
            ->merge($certificates)
            ->merge($tariffOrders)
            ->merge($tariffPetition)
            ->merge($rtis)
            ->merge($annualStatements)
            ->merge($annualReturns)
            ->merge($reports)
            ->merge($publications)
            ->merge($standardForms)
            ->merge($csrs)
            ->merge($calendars)
            ->merge($disasterManagements)
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
