<?php

use App\Http\Controllers\QuizRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [QuizRegistrationController::class, 'index'])->name('quiz.register');
Route::post('/', [QuizRegistrationController::class, 'store'])->name('quiz.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
