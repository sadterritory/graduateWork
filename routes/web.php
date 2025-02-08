<?php


use Illuminate\Support\Facades\Route;

Auth::routes();

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Catch-all route for SPA
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*')->name('application');
