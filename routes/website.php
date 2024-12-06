<?php

use App\Http\Controllers\ActsPoliciesServiceRulesController;
use App\Http\Controllers\AnnualReturnController;
use App\Http\Controllers\AnnualStatementController;
use App\Http\Controllers\ApprenticeshipController;
use App\Http\Controllers\BoardOfDirectorsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CSRController;
use App\Http\Controllers\DamSafetyController;
use App\Http\Controllers\DisasterManagementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\LKHEPPolicyController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OngoingProjectsController;
use App\Http\Controllers\ProjectsInPipelineController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RightToInformationController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\StandardFormController;
use App\Http\Controllers\TariffOrderController;
use App\Http\Controllers\TariffPetitionController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\WebsiteHomeController;
use Illuminate\Support\Facades\Route;

// Routes that require localization
Route::middleware('locale')->group(function () {
    Route::get('/{lang?}', [WebsiteHomeController::class, 'index'])->name('welcome');

    // Route::get('/{lang}/about-us/gallery', function ($lang) {
    //     App::setLocale($lang);
    //     return view('website.aboutUs.gallery');
    // });

    Route::prefix('{lang}')->group(function () {
        Route::view('about-us', '');
        Route::prefix('about-us')->group(function () {
            Route::get('board-of-directors', [BoardOfDirectorsController::class, 'websiteIndex']);
            Route::get('company-profile', [CompanyProfileController::class, 'websiteIndex'])->name('company-profile.websiteIndex');
            Route::get('offices', [OfficeController::class, 'websiteIndex']);
            Route::get('gallery', [GalleryController::class, 'websiteIndex']);
            Route::get('gallery/{gallery}', [GalleryController::class, 'websiteShow']);
        });
        Route::prefix('documents')->group(function () {
            Route::get('rosters', [RosterController::class, 'websiteIndex']);
            Route::get('acts-policies-service-rules', [ActsPoliciesServiceRulesController::class, 'websiteIndex']);
            Route::get('certificates', [CertificateController::class, 'websiteIndex']);
            Route::get('tariff-order', [TariffOrderController::class, 'websiteIndex']);
            Route::get('tariff-petition', [TariffPetitionController::class, 'websiteIndex']);
            Route::get('right-to-information', [RightToInformationController::class, 'websiteIndex']);
            Route::get('annual-statements', [AnnualStatementController::class, 'websiteIndex']);
            Route::get('annual-returns', [AnnualReturnController::class, 'websiteIndex']);
            Route::get('reports', [ReportController::class, 'websiteIndex']);
            Route::get('publications', [PublicationController::class, 'websiteIndex']);
            Route::get('standard-forms', [StandardFormController::class, 'websiteIndex']);
        });
        Route::prefix('projects')->group(function () {
            Route::prefix('hydro-plants')->group(function () {
                Route::view('klhep', 'website.projects.hydro-plants.klhep');
                Route::view('mshep', 'website.projects.hydro-plants.mshep');
            });
            Route::prefix('thermal-plants')->group(function () {
                Route::view('ntps', 'website.projects.thermal-plants.ntps');
                Route::view('nrpp', 'website.projects.thermal-plants.nrpp');
                Route::view('ltps', 'website.projects.thermal-plants.ltps');
                Route::view('lrpp', 'website.projects.thermal-plants.lrpp');
            });
            Route::prefix('ongoing-projects')->group(function () {
                Route::get('lkhep', [LKHEPPolicyController::class, 'websiteIndex']);
            });
            Route::view('hydro-plants', 'website.projects.hydro-plants');
            Route::view('thermal-plants', 'website.projects.thermal-plants');
            Route::get('ongoing-projects', [OngoingProjectsController::class, 'websiteIndex']);
            Route::get('projects-in-pipeline', [ProjectsInPipelineController::class, 'websiteIndex']);
        });
        Route::prefix('tenders')->group(function () {
            Route::get('current-financial-year', [TenderController::class, 'websiteIndex']);
            Route::get('archive', [TenderController::class, 'archivedTenders']);
        });
        Route::prefix('career')->group(function () {
            Route::get('internship', [InternshipController::class, 'websiteIndex']);
            Route::get('apprenticeship', [ApprenticeshipController::class, 'websiteIndex']);
            Route::get('recruitments', [RecruitmentController::class, 'websiteIndex']);
        });
        Route::view('site-map', 'website.site-map')->name('site-map.websiteIndex');
        Route::view('screen-reader', 'website.screen-reader')->name('screen-reader.websiteIndex');
        Route::view('hyperlink-policies', 'website.hyperlink-policies')->name('hyperlink-policies.websiteIndex');
        Route::view('copyright-policies', 'website.copyright-policies')->name('copyright-policies.websiteIndex');
        Route::view('privacy-policies', 'website.privacy-policies')->name('privacy-policies.websiteIndex');
        Route::view('disclaimer', 'website.disclaimer')->name('disclaimer.websiteIndex');
        Route::get('contact-us', [ContactController::class, 'websiteIndex']);
        Route::get('corporate-social-responsibility', [CSRController::class, 'websiteIndex']);
        Route::get('disaster-management', [DisasterManagementController::class, 'websiteIndex']);
        Route::get('dam-safety', [DamSafetyController::class, 'websiteIndex']);
        Route::get('calendars-and-holidays', [CalendarController::class, 'websiteIndex']);
    });
});