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

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});

require __DIR__.'/admin.php';
require __DIR__.'/website.php';

// Include the auth routes
require __DIR__.'/auth.php';
