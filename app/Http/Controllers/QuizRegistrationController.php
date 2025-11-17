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
        $remainingSpots = 60 - $currentTotal;

        return Inertia::render('QuizRegistration/Index', [
            'remainingSpots' => $remainingSpots,
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
