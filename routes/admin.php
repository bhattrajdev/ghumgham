<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

// Route for displaying login page
Route::get('/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

// Route to handle login form submission
Route::post('/login', [AdminAuthController::class, 'authenticate'])
    ->name('admin.storeLogin');

// Group all admin routes and apply authentication middleware
// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // ------------------------------- DASHBOARD ROUTES --------------------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ------------------------------- BLOGS ROUTES ------------------------------------
    Route::controller(BlogController::class)->group(function () {
        Route::get('blogs/status', 'changeStatus')->name("blogs.status");
        Route::resource('blogs', BlogController::class)->except('destroy');
    });

    // ------------------------------- LOCATION ROUTES ------------------------------------
    Route::controller(LocationController::class)->group(function () {
        Route::get('location/status', 'changeStatus')->name("locations.status");
        Route::resource('locations', LocationController::class)->except('destroy');
    });

    // ------------------------------- LOCATION ROUTES ------------------------------------
    Route::controller(SiteSettingController::class)->group(function () {
        Route::resource('sitesettings', SiteSettingController::class)->only('index', 'update',);
    });
});
