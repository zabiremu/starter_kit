<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Web\Backend\Settings\MailController;
use App\Http\Controllers\Web\Backend\Settings\CompanyController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/', 'index');
    });

    //Company Information Route
    Route::controller(CompanyController::class)->prefix('company-information')->name('company-information.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //Mail Settings Route
    Route::controller(MailController::class)->prefix('mail-settings')->name('mail-settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });
    //User Route
    Route::controller(ProfileController::class)->prefix('admin-profile')->name('admin.profile.')->group(function () {
        Route::get('/admin', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });
});
