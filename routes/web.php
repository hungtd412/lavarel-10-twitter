<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {

    Route::post('', [IdeaController::class, 'store'])->name('store');

    Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

        Route::put('{idea}', [IdeaController::class, 'update'])->name('update');

        Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');
        //middleware('auth'): if the user did not log in, the middleware will direct them to login page

        Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});


Route::get('/terms', function () {
    return view('terms');
});

Route::get('/x', function () {
    return view('x');
})->name('x');
