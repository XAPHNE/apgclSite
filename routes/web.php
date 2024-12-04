<?php

use App\Http\Controllers\ActController;
use App\Http\Controllers\ActsPoliciesServiceRulesController;
use App\Http\Controllers\AnnualReturnController;
use App\Http\Controllers\AnnualStatementController;
use App\Http\Controllers\ApprenticeshipController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BoardOfDirectorsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CSRController;
use App\Http\Controllers\DailyGenerationController;
use App\Http\Controllers\DamSafetyController;
use App\Http\Controllers\DisasterManagementController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryFileController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\LKHEPPolicyController;
use App\Http\Controllers\NewsAndEventController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OngoingProjectsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsInPipelineController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RightToInformationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\ServiceRuleController;
use App\Http\Controllers\StandardFormController;
use App\Http\Controllers\TariffOrderController;
use App\Http\Controllers\TariffPetitionController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\TenderFileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteHomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication routes (without localization)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'twofactor'])->name('dashboard');

Route::middleware(['auth', 'password.change'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('profile', ProfileController::class)->only(['index', 'update']);
        Route::middleware('role:Super Admin')->group(function () {
            Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');
            Route::prefix('roles-and-permissions')->group(function () {
                Route::resource('roles', RoleController::class);
                Route::post('roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assign-permissions');
                Route::resource('permissions', PermissionController::class);
            });
            Route::prefix('about-us')->group(function () {
                Route::resource('board-of-directors', BoardOfDirectorsController::class);
                Route::resource('gallery', GalleryController::class);
                Route::resource('gallery.gallery-files', GalleryFileController::class)
                    ->only(['store', 'update', 'destroy'])
                    ->scoped(['galleryFile' => 'id',]);
            });
            Route::prefix('documents')->group(function () {
                Route::resource('rosters', RosterController::class);
                Route::resource('acts', ActController::class);
                Route::resource('policies', PolicyController::class);
                Route::resource('service-rules', ServiceRuleController::class);
                Route::resource('certificates', CertificateController::class);
                Route::resource('tariff-order', TariffOrderController::class);
                Route::resource('tariff-petition', TariffPetitionController::class);
                Route::resource('right-to-information', RightToInformationController::class);
                Route::resource('annual-statements', AnnualStatementController::class);
                Route::resource('annual-returns', AnnualReturnController::class);
                Route::resource('reports', ReportController::class);
                Route::resource('publications', PublicationController::class);
                Route::resource('standard-forms', StandardFormController::class);
            });
            Route::prefix('projects')->group(function () {
                Route::prefix('ongoing-projects')->group(function () {
                    Route::resource('lkhep', LKHEPPolicyController::class);
                });
                Route::resource('ongoing-projects', OngoingProjectsController::class);
                Route::resource('projects-in-pipeline', ProjectsInPipelineController::class);
            });
            Route::prefix('career')->group(function () {
                Route::resource('apprenticeship', ApprenticeshipController::class);
                Route::resource('recruitments', RecruitmentController::class);
            });
            Route::resource('news-and-events', NewsAndEventController::class);
            Route::resource('contact-us', ContactController::class);
            Route::resource('calendars', CalendarController::class);
            Route::resource('corporate-social-responsibility', CSRController::class);
            Route::resource('disaster-management', DisasterManagementController::class);
            Route::resource('dam-safety', DamSafetyController::class);
            Route::resource('users', UserController::class);
            Route::post('users/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('users.assign-roles');
        });
        Route::middleware('role:Super Admin|Tender Uploader')->group(function () {
            Route::prefix('tenders')->group(function () {
                Route::resource('financial-years', FinancialYearController::class);
            });
            Route::resource('tenders', TenderController::class);
            Route::resource('tenders.tender-files', TenderFileController::class)
                ->only(['store', 'update', 'destroy'])
                ->scoped(['tenderFile' => 'id',]);
        });
        Route::middleware('role:Super Admin|Daily Generation Updater')->group(function () {
            Route::resource('daily-generation', DailyGenerationController::class);
        });
    });
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});

// Routes that require localization
Route::middleware('locale')->group(function () {
    Route::get('/{lang?}', [WebsiteHomeController::class, 'index'])->name('welcome');

    Route::get('/{lang}/about-us/gallery', function ($lang) {
        App::setLocale($lang);
        return view('website.aboutUs.gallery');
    });

    Route::prefix('{lang}')->group(function () {
        Route::prefix('about-us')->group(function () {
            Route::get('board-of-directors', [BoardOfDirectorsController::class, 'websiteIndex']);
            Route::get('company-profile', [CompanyProfileController::class, 'websiteIndex']);
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
        Route::get('contact-us', [ContactController::class, 'websiteIndex']);
        Route::get('corporate-social-responsibility', [CSRController::class, 'websiteIndex']);
        Route::get('disaster-management', [DisasterManagementController::class, 'websiteIndex']);
        Route::get('dam-safety', [DamSafetyController::class, 'websiteIndex']);
        Route::get('calendars-and-holidays', [CalendarController::class, 'websiteIndex']);
    });
});

// Include the auth routes
require __DIR__.'/auth.php';
