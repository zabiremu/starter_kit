<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Web\Backend\Settings\MailController;
use App\Http\Controllers\Web\Backend\Settings\CompanyController;
use App\Http\Controllers\Web\Backend\Home\HeroController;
use App\Http\Controllers\Web\Backend\Home\AchivementController;



Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/', 'index');
    });

    //Company Information Route
    Route::controller(CompanyController::class)->prefix('company-information')->name('companyinformation.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //Mail Settings Route
    Route::controller(MailController::class)->prefix('mail-settings')->name('mailsettings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });
});
