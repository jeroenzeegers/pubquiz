<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizRegistration;
use Inertia\Inertia;
use Inertia\Response;

class QuizRegistrationController extends Controller
{
    public function index(): Response
    {
        $registrations = QuizRegistration::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSpots = 60;
        $filledSpots = QuizRegistration::sum('team_size');
        $remainingSpots = $totalSpots - $filledSpots;

        return Inertia::render('Admin/QuizRegistrations/Index', [
            'registrations' => $registrations,
            'totalSpots' => $totalSpots,
            'filledSpots' => $filledSpots,
            'remainingSpots' => $remainingSpots,
        ]);
    }
}
