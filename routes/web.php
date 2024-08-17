<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;



Route::get('', [FrontendController::class, 'welcome'])->name('welcome');
Route::get('location/{slug}', [FrontendController::class, 'getLocation'])->name('getLocation');
Route::get('location/{slug}', [FrontendController::class, 'getBlog'])->name('getBlog');

