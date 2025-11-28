<?php

namespace App\Livewire\Admin;

use App\Models\QuizRegistration;
use Livewire\Component;

class QuizRegistrations extends Component
{
    public function render()
    {
        $registrations = QuizRegistration::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSpots = 75;
        $filledSpots = QuizRegistration::sum('team_size');
        $remainingSpots = $totalSpots - $filledSpots;
        $fillPercentage = ($filledSpots / $totalSpots) * 100;

        return view('livewire.admin.quiz-registrations', [
            'registrations' => $registrations,
            'totalSpots' => $totalSpots,
            'filledSpots' => $filledSpots,
            'remainingSpots' => $remainingSpots,
            'fillPercentage' => $fillPercentage,
        ])->layout('components.layouts.admin', ['title' => 'Quiz Registraties - Admin']);
    }
}
