<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {

//     Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

// Route::group(['middleware' => ['auth']], function () {
//         Route::post('', [IdeaController::class, 'store'])->name('store');

//         Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

//         Route::put('{idea}', [IdeaController::class, 'update'])->name('update');

//         Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');
//         //middleware('auth'): if the user did not log in, the middleware will direct them to login page

// Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
//     });
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only('show');

Route::resource('ideas.comments', CommentController::class)->only('store')->middleware('auth');

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/x', function () {
    return view('x');
})->name('x');
