<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register',[App\Http\Controllers\UserController::class, 'store'])->name('userregister');

Route::middleware(['auth'])->group(function () {

    Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edituser');
    Route::put('/updateuser', [App\Http\Controllers\UserController::class, 'update'])->name('updateuser');

    Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user',[App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/message',[App\Http\Controllers\MessageController::class, 'index'])->name('message');



     Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/summary', [App\Http\Controllers\MessageController::class, 'conversationsSummary'])->name('messages.summary');
    Route::get('/messages/{user}', [App\Http\Controllers\MessageController::class, 'conversation'])->name('messages.conversation');
    Route::post('/messages/{user}', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
});

