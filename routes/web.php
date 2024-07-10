<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/{lang?}', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale'); // Ensure fallback to default locale
    }
    App::setLocale($lang);
    return view('welcome');
});

Route::get('/{lang?}/about-us/company-profile', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.aboutUs.companyProfile');
});

Route::get('/{lang?}/about-us/board-of-directors', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.aboutUs.boardOfDirectors');
});

Route::get('/{lang?}/about-us/offices', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.aboutUs.offices');
});

Route::get('/{lang?}/about-us/gallery', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.aboutUs.gallery');
});

Route::get('/{lang?}/documents/acts-policies-service-rules', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.documents.actsPoliciesServiceRules');
});

Route::get('/{lang?}/documents/certificates', function ($lang = null) {
    if (!$lang) {
        $lang = config('app.fallback_locale');
    }
    App::setLocale($lang);
    return view('website.documents.certificate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
