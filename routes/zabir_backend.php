<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\Role\RoleController;
use App\Http\Controllers\Web\Backend\User\UserController;
use App\Http\Controllers\Web\Backend\Settings\MailController;
use App\Http\Controllers\Web\Backend\Settings\CompanyController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\PasswordController;
use App\Http\Controllers\Web\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Web\Backend\Permissions\PermissionsController;
use App\Http\Controllers\Web\Backend\Settings\GeneralInformationController;

Route::middleware('auth')->group(function () {
    // Dashboard Routes
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/', 'index')->middleware('can:Dashboard Menu');
    });

    //Company Information Routes
    Route::controller(CompanyController::class)->prefix('company-information')->name('company-information.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Company Information');
        Route::post('/update', 'update')->name('update')->middleware('can:Company Information Update');
    });

    //Mail Settings Routes
    Route::controller(MailController::class)->prefix('mail-settings')->name('mail-settings.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Mail Settings');
        Route::post('/update', 'update')->name('update')->middleware('can:Mail Settings Update');
    });

    //User Routes
    Route::controller(ProfileController::class)->prefix('admin-profile')->name('admin.profile.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Profile Settings');
        Route::post('/update', 'update')->name('update')->middleware('can:Profile Settings Update');
    });

    //User Password Update Routes
    Route::controller(PasswordController::class)->prefix('admin-password')->name('admin.password.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Password Settings');
        Route::post('/update', 'update')->name('update')->middleware('can:Password Settings Update');
    });

    //General Information Routes
    Route::controller(GeneralInformationController::class)->prefix('general-information')->name('admin.general-information.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:PGeneral Information');
        Route::post('/update', 'update')->name('update')->middleware('can:General Information Update');
    });

    //Users Routes
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Users Menu');
        Route::get('/create', 'create')->name('create')->middleware('can:Users Create');
        Route::post('/store', 'store')->name('store')->middleware('can:Users Store');
        Route::put('/edit-assign-role', 'editAssignRole')->name('editAssignRole')->middleware('can:Users Update');
        Route::get('/status/{id}', 'status')->name('status')->middleware('can:Users Status');
        Route::get('/destroy/{id}', 'destroy')->name('destroy')->middleware('can:Users Delete');
    });

    //Roles Routes
    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:Role Menu');
        Route::get('/create', 'create')->name('create')->middleware('can:Role Create');
        Route::post('/store', 'store')->name('store')->middleware('can:Role Store');
        Route::get('/edit/{id}', 'edit')->name('edit')->middleware('can:Role Edit');
        Route::put('/update', 'update')->name('update')->middleware('can:Role Update');
        Route::get('/status/{id}', 'status')->name('status')->middleware('can:Role Status');
        Route::get('/destroy/{id}', 'destroy')->name('destroy')->middleware('can:Role Delete');
    });
    //Permissions Routes
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('admin.permissions')->middleware('can:Permissions Menu');
    Route::post('get-permissions', [PermissionsController::class, 'get_permissions'])->name('get.permissions');
    Route::post('/store-permissions', [PermissionsController::class, 'store'])->name('store.permissions')->middleware('can:Permissions Store');
});
