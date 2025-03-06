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
use App\Models\Tender;
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
        $models = [
            NewsAndEvent::class,
            Act::class,
            Policy::class,
            ServiceRule::class,
            Certificate::class,
            TariffOrder::class,
            TariffPetition::class,
            RightToInformation::class,
            AnnualStatement::class,
            AnnualReturn::class,
            Report::class,
            Publication::class,
            StandardForm::class,
            CSR::class,
            Calendar::class,
            DisasterManagement::class,
            DamSafety::class,
            Recruitment::class,
            Apprenticeship::class,
        ];

        // Total count of News & Events
        $totalNAECount = Cache::remember('totalNAECount', now()->addMinutes(5), function () use ($models) {
            return collect($models)->sum(function ($model) {
                return $model::where('news_n_events', true)->count();
            });
        });

        // Total count of "new" News & Events
        $totalNAEisNewCount = Cache::remember('totalNAEisNewCount', now()->addMinutes(5), function () use ($models) {
            return collect($models)->sum(function ($model) {
                return $model::where('news_n_events', true)->where('new_badge', true)->count();
            });
        });

        // Latest "new" entries
        $latestEntriesNewNAE = Cache::remember('latestEntriesNewNAE', now()->addMinutes(5), function () use ($models) {
            return collect($models)->flatMap(function ($model) {
                return $model::where('news_n_events', true)
                    ->where('new_badge', true)
                    ->latest()
                    ->get();
            })->sortByDesc('created_at')->values();
        });

        // Latest all entries
        $latestEntriesNAE = Cache::remember('latestEntriesNAE', now()->addMinutes(5), function () use ($models) {
            return collect($models)->flatMap(function ($model) {
                return $model::where('news_n_events', true)
                    ->latest()
                    ->get();
            })->sortByDesc('created_at')->values();
        });

        $currentFY = FinancialYear::latest()->first();
        $tenderCount = $currentFY ? $currentFY->tenders()->count() : 0;

        $tenders = $currentFY ? Tender::with('tenderFiles')->where('financial_year_id', $currentFY->id)->latest()->get() : collect();

        $tendersForReview = Tender::with('financialYear', 'tenderFiles')
            ->where('for_review', true)
            ->latest()
            ->get();
        $tendersForReviewCount = $tendersForReview->count();

        // $registeredUsersCount = Cache::remember('registeredUsersCount', now()->addMinutes(5), function () {
        //     return User::count();
        // });

        // $users = User::latest()->get();

        return view('dashboard', compact(
            'totalNAECount',
            'totalNAEisNewCount',
            'currentFY',
            'tenderCount',
            'tendersForReviewCount',
            'latestEntriesNewNAE',
            'latestEntriesNAE',
            'tendersForReview',
            'tenders',
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
