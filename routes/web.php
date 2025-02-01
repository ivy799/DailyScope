<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

Route::get('/', HomeController::class)->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
