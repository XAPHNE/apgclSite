<?php

namespace App\Providers;

use App\Models\FinancialYear;
use App\Models\Tender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.partials.sidebar', function ($view) {
            $user = Auth::user();
    
            if (!$user) {
                return;
            }

            // $currentFY = FinancialYear::latest()->first();
    
            if ($user->hasRole('Super Admin')) {
                // Super Admin sees all tenders
                $forReviewCount = Tender::where('for_review', true)->count();
                $publishedCount = Tender::where('for_review', false)
                    // ->where('financial_year_id', $currentFY->id)
                    ->count();
            } elseif ($user->hasRole('Tender Uploader')) {
                // Tender Uploader sees only tenders in their department
                $forReviewCount = Tender::where('for_review', true)
                                        ->where('department', $user->department)
                                        ->count();
    
                $publishedCount = Tender::where('for_review', false)
                                        // ->where('financial_year_id', $currentFY->id)
                                        ->where('department', $user->department)
                                        ->count();
            } else {
                $forReviewCount = 0;
                $publishedCount = 0;
            }
    
            $view->with([
                'forReviewCount' => $forReviewCount,
                'publishedCount' => $publishedCount,
            ]);
        });
    }
}
