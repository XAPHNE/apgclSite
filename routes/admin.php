<?php

use App\Http\Controllers\ActController;
use App\Http\Controllers\AnnualReturnController;
use App\Http\Controllers\AnnualStatementController;
use App\Http\Controllers\ApprenticeshipController;
use App\Http\Controllers\BoardOfDirectorsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CSRController;
use App\Http\Controllers\DailyGenerationController;
use App\Http\Controllers\DamSafetyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisasterManagementController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmployeeDetailController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryFileController;
use App\Http\Controllers\LKHEPPolicyController;
use App\Http\Controllers\NewsAndEventController;
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
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'twofactor', 'password.change'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('profile', ProfileController::class)->only('index', 'update');
        Route::middleware('role:Super Admin')->group(function () {
            Route::resource('dashboard', DashboardController::class)->only('index');
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
            Route::resource('employee-details', EmployeeDetailController::class);
            Route::resource('events', EventController::class);
            Route::resource('email-templates', EmailTemplateController::class);
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