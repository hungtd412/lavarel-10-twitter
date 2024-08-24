<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [dashboardController::class, 'index']);

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/profile', [ProfileController::class, 'index']);
