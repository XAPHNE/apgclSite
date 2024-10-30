<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnualReturnController;
use App\Http\Controllers\AnnualStatementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CSRController;
use App\Http\Controllers\DailyGenerationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DisasterManagementController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RightToInformationController;
use App\Http\Controllers\StandardFormController;
use App\Http\Controllers\TariffOrderController;
use App\Http\Controllers\TariffPetitionController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\TwoFactorController;
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

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'twofactor'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tenders', function () { return view('admin.tenders.index'); })->name('tenders.index');
    Route::resource('certificate', CertificateController::class);
    Route::resource('tariff-order', TariffOrderController::class);
    Route::resource('tariff-petition', TariffPetitionController::class);
    
    
    Route::resource('departments', DepartmentController::class);
    Route::resource('user-management', AdminController::class);
    Route::resource('financial-years', FinancialYearController::class);
    Route::resource('admin/disaster-management', DisasterManagementController::class);
    Route::resource('admin/corporate-social-responsibility', CSRController::class);
    Route::resource('admin/calendar', CalendarController::class);
    Route::resource('admin/daily-generation', DailyGenerationController::class);
    Route::resource('admin/contacts', ContactController::class);

    Route::prefix('admin')->group(function () {
        Route::prefix('documents')->group(function () {
            Route::resource('tariff-petition', TariffPetitionController::class);
            Route::resource('right-to-information', RightToInformationController::class);
            Route::resource('annual-statements', AnnualStatementController::class);
            Route::resource('annual-returns', AnnualReturnController::class);
            Route::resource('reports', ReportController::class);
            Route::resource('publications', PublicationController::class);
            Route::resource('standard-forms', StandardFormController::class);
        });
    });



    // Route::get('/addUser', [AdminController::class, 'index'])->name('add-user');
    // Route::post('/register-user', [AdminController::class, 'registerUser'])->name('register-user');
    // Route::post('/update-role', [AdminController::class, 'check']);
    // Route::get('/editUser/{id}', [AdminController::class, 'editUser']);
    // Route::post('/update-user', [AdminController::class, 'updateUser']);
    // Route::post('/deleteUser', [AdminController::class, 'deleteUser']);
    
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});

// Routes that require localization
Route::middleware('locale')->group(function () {
    Route::get('/{lang?}', [WebsiteHomeController::class, 'index'])->name('welcome');

    Route::get('/{lang}/about-us/company-profile', function ($lang) {
        App::setLocale($lang);
        return view('website.aboutUs.companyProfile');
    });

    Route::get('/{lang}/about-us/board-of-directors', function ($lang) {
        App::setLocale($lang);
        return view('website.aboutUs.boardOfDirectors');
    });

    Route::get('/{lang}/about-us/offices', function ($lang) {
        App::setLocale($lang);
        return view('website.aboutUs.offices');
    });

    Route::get('/{lang}/about-us/gallery', function ($lang) {
        App::setLocale($lang);
        return view('website.aboutUs.gallery');
    });

    Route::get('/{lang}/documents/acts-policies-service-rules', function ($lang) {
        App::setLocale($lang);
        return view('website.documents.actsPoliciesServiceRules');
    });

    Route::get('/{lang}/documents/certificates', function ($lang) {
        App::setLocale($lang);
        return view('website.documents.certificate');
    });

    Route::prefix('{lang}')->group(function () {
        Route::prefix('documents')->group(function () {
            Route::get('tariff-petition', [TariffPetitionController::class, 'websiteIndex']);
            Route::get('right-to-information', [RightToInformationController::class, 'websiteIndex']);
            Route::get('annual-statements', [AnnualStatementController::class, 'websiteIndex']);
            Route::get('annual-returns', [AnnualReturnController::class, 'websiteIndex']);
            Route::get('reports', [ReportController::class, 'websiteIndex']);
            Route::get('publications', [PublicationController::class, 'websiteIndex']);
            Route::get('standard-forms', [StandardFormController::class, 'websiteIndex']);
        });
    });
});

// Include the auth routes
require __DIR__.'/auth.php';
