<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
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
})->middleware(['auth', 'twofactor'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});

// Routes that require localization
Route::middleware('locale')->group(function () {
    Route::get('/{lang?}', function ($lang = null) {
        if (!$lang) {
            $lang = config('app.fallback_locale'); // Ensure fallback to default locale
        }
        App::setLocale($lang);
        return view('welcome');
    });

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
});

// Include the auth routes
require __DIR__.'/auth.php';
