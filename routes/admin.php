<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LocationController;
use Illuminate\Support\Facades\Route;

// Route for displaying login page
Route::get('/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');
// ->middleware('redirect_if_authenticated');

// Route to handle login form submission
Route::post('/login', [AdminAuthController::class, 'authenticate'])
    ->name('admin.login');

// Group all admin routes and apply authentication middleware
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    // ------------------------------- DASHBOARD ROUTES --------------------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ------------------------------- BLOGS ROUTES ------------------------------------
    Route::controller(BlogController::class)->group(function () {
        Route::get('blogs/status', 'changeStatus')->name("blogs.status");
        Route::resource('blogs', BlogController::class);
    });

    // ------------------------------- LOCATION ROUTES ------------------------------------
    Route::controller(LocationController::class)->group(function () {
        Route::get('location/status', 'changeStatus')->name("locations.status");
        Route::resource('locations', LocationController::class);
    });
});
