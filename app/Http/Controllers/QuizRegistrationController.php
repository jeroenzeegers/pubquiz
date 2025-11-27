<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRegistrationRequest;
use App\Mail\QuizRegistrationConfirmation;
use App\Models\QuizRegistration;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class QuizRegistrationController extends Controller
{
    public function index(): Response
    {
        $currentTotal = QuizRegistration::sum('team_size');
        $remainingSpots = 75 - $currentTotal;

        return Inertia::render('QuizRegistration/Index', [
            'remainingSpots' => $remainingSpots,
            'seo' => [
                'title' => 'Pubquiz Aanmelding - Weetje Ietta?',
                'description' => 'Meld je aan voor de Scheveningse Pubquiz onder leiding van Arie Spaans. Zaterdag 13 december van 20:00 tot 22:00 uur. Nog '.max(0, $remainingSpots).' plekken beschikbaar!',
                'url' => config('app.url'),
                'type' => 'event',
            ],
        ]);
    }

    public function store(StoreQuizRegistrationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $registration = QuizRegistration::create($request->validated());

        Mail::to($registration->email)
            ->cc('s.james@muzee.nl')
            ->send(new QuizRegistrationConfirmation($registration));

        return redirect()->route('quiz.register')->with('success', 'Je aanmelding is succesvol ontvangen! Je ontvangt een bevestiging per e-mail.');
    }
}
