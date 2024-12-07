<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\AnnualReturn;
use App\Models\AnnualStatement;
use App\Models\Apprenticeship;
use App\Models\Calendar;
use App\Models\Certificate;
use App\Models\CSR;
use App\Models\DamSafety;
use App\Models\DisasterManagement;
use App\Models\FinancialYear;
use App\Models\NewsAndEvent;
use App\Models\Policy;
use App\Models\Publication;
use App\Models\Recruitment;
use App\Models\Report;
use App\Models\RightToInformation;
use App\Models\ServiceRule;
use App\Models\StandardForm;
use App\Models\TariffOrder;
use App\Models\TariffPetition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalNAECount = Cache::remember('totalNAECount', now()->addMinutes(5), function () {
            return NewsAndEvent::where('news_n_events', true)->count()
                + Act::where('news_n_events', true)->count()
                + Policy::where('news_n_events', true)->count()
                + ServiceRule::where('news_n_events', true)->count()
                + Certificate::where('news_n_events', true)->count()
                + TariffOrder::where('news_n_events', true)->count()
                + TariffPetition::where('news_n_events', true)->count()
                + RightToInformation::where('news_n_events', true)->count()
                + AnnualStatement::where('news_n_events', true)->count()
                + AnnualReturn::where('news_n_events', true)->count()
                + Report::where('news_n_events', true)->count()
                + Publication::where('news_n_events', true)->count()
                + StandardForm::where('news_n_events', true)->count()
                + CSR::where('news_n_events', true)->count()
                + Calendar::where('news_n_events', true)->count()
                + DisasterManagement::where('news_n_events', true)->count()
                + DamSafety::where('news_n_events', true)->count()
                + Recruitment::where('news_n_events', true)->count()
                + Apprenticeship::where('news_n_events', true)->count();
        });

        $totalNAEisNewCount = Cache::remember('totalNAECount', now()->addMinutes(5), function () {
            return NewsAndEvent::where('news_n_events', true)->where('new_badge', true)->count()
                + Act::where('news_n_events', true)->where('new_badge', true)->count()
                + Policy::where('news_n_events', true)->where('new_badge', true)->count()
                + ServiceRule::where('news_n_events', true)->where('new_badge', true)->count()
                + Certificate::where('news_n_events', true)->where('new_badge', true)->count()
                + TariffOrder::where('news_n_events', true)->where('new_badge', true)->count()
                + TariffPetition::where('news_n_events', true)->where('new_badge', true)->count()
                + RightToInformation::where('news_n_events', true)->where('new_badge', true)->count()
                + AnnualStatement::where('news_n_events', true)->where('new_badge', true)->count()
                + AnnualReturn::where('news_n_events', true)->where('new_badge', true)->count()
                + Report::where('news_n_events', true)->where('new_badge', true)->count()
                + Publication::where('news_n_events', true)->where('new_badge', true)->count()
                + StandardForm::where('news_n_events', true)->where('new_badge', true)->count()
                + CSR::where('news_n_events', true)->where('new_badge', true)->count()
                + Calendar::where('news_n_events', true)->where('new_badge', true)->count()
                + DisasterManagement::where('news_n_events', true)->where('new_badge', true)->count()
                + DamSafety::where('news_n_events', true)->where('new_badge', true)->count()
                + Recruitment::where('news_n_events', true)->where('new_badge', true)->count()
                + Apprenticeship::where('news_n_events', true)->where('new_badge', true)->count();
        });

        $newNewsAndEvents = NewsAndEvent::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newActs = Act::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newPolicies = Policy::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newServiceRules = ServiceRule::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newCertificates = Certificate::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newTariffOrders = TariffOrder::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newTariffPetition = TariffPetition::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newRtis = RightToInformation::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newAnnualStatements = AnnualStatement::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newAnnualReturns = AnnualReturn::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newReports = Report::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newPublications = Publication::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newStandardForms = StandardForm::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newCsrs = CSR::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newCalendars = Calendar::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newDisasterManagements = DisasterManagement::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newDamSafeties = DamSafety::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newRecruitments = Recruitment::where('news_n_events', true)->where('new_badge', true)->latest()->get();
        $newApprenticeships = Apprenticeship::where('news_n_events', true)->where('new_badge', true)->latest()->get();

        $latestEntriesNewNAE = collect($newNewsAndEvents)
            ->merge($newActs)
            ->merge($newPolicies)
            ->merge($newServiceRules)
            ->merge($newCertificates)
            ->merge($newTariffOrders)
            ->merge($newTariffPetition)
            ->merge($newRtis)
            ->merge($newAnnualStatements)
            ->merge($newAnnualReturns)
            ->merge($newReports)
            ->merge($newPublications)
            ->merge($newStandardForms)
            ->merge($newCsrs)
            ->merge($newCalendars)
            ->merge($newDisasterManagements)
            ->merge($newDamSafeties)
            ->merge($newRecruitments)
            ->merge($newApprenticeships)
            ->sortByDesc('created_at')
            ->values();

        

        $newsAndEvents = NewsAndEvent::where('news_n_events', true)->latest()->get();
        $acts = Act::where('news_n_events', true)->latest()->get();
        $policies = Policy::where('news_n_events', true)->latest()->get();
        $serviceRules = ServiceRule::where('news_n_events', true)->latest()->get();
        $certificates = Certificate::where('news_n_events', true)->latest()->get();
        $tariffOrders = TariffOrder::where('news_n_events', true)->latest()->get();
        $tariffPetition = TariffPetition::where('news_n_events', true)->latest()->get();
        $rtis = RightToInformation::where('news_n_events', true)->latest()->get();
        $annualStatements = AnnualStatement::where('news_n_events', true)->latest()->get();
        $annualReturns = AnnualReturn::where('news_n_events', true)->latest()->get();
        $reports = Report::where('news_n_events', true)->latest()->get();
        $publications = Publication::where('news_n_events', true)->latest()->get();
        $standardForms = StandardForm::where('news_n_events', true)->latest()->get();
        $csrs = CSR::where('news_n_events', true)->latest()->get();
        $calendars = Calendar::where('news_n_events', true)->latest()->get();
        $disasterManagements = DisasterManagement::where('news_n_events', true)->latest()->get();
        $damSafeties = DamSafety::where('news_n_events', true)->latest()->get();
        $recruitments = Recruitment::where('news_n_events', true)->latest()->get();
        $apprenticeships = Apprenticeship::where('news_n_events', true)->latest()->get();

        $latestEntriesNAE = collect($newsAndEvents)
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
            ->merge($damSafeties)
            ->merge($recruitments)
            ->merge($apprenticeships)
            ->sortByDesc('created_at')
            ->values();
    
        $currentFY = FinancialYear::latest()->first();
        $tenderCount = $currentFY ? $currentFY->tenders()->count() : 0;
    
        $registeredUsersCount = User::all()->count();
        return view('dashboard', compact(
            'totalNAECount', 
            'totalNAEisNewCount', 
            'currentFY', 
            'tenderCount', 
            'registeredUsersCount', 
            'latestEntriesNewNAE',
            'latestEntriesNAE'
        ));
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
