<?php

use App\Http\Controllers\QuizRegistrationController;
use App\Livewire\Admin\QuizRegistrations;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [QuizRegistrationController::class, 'index'])->name('quiz.register');
Route::post('/', [QuizRegistrationController::class, 'store'])->name('quiz.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('admin/quiz-registrations', QuizRegistrations::class)->name('admin.quiz-registrations.index');
});

require __DIR__.'/settings.php';
