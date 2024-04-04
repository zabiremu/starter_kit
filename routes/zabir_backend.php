<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\Settings\MailController;
use App\Http\Controllers\Web\Backend\Settings\CompanyController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\PasswordController;
use App\Http\Controllers\Web\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Web\Backend\Settings\GeneralInformationController;
use App\Http\Controllers\Web\Backend\User\UserController;

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
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //User Password Update Route
    Route::controller(PasswordController::class)->prefix('admin-password')->name('admin.password.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //General Information Route
    Route::controller(GeneralInformationController::class)->prefix('general-information')->name('admin.general-information.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    //Users Route
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/status/{id}', 'status')->name('status');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
});
