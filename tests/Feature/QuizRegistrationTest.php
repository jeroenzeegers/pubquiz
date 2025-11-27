<?php

use App\Mail\QuizRegistrationConfirmation;
use App\Models\QuizRegistration;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\assertDatabaseHas;

test('quiz registration page can be rendered', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page
        ->component('QuizRegistration/Index')
        ->has('remainingSpots')
    );
});

test('users can register for the quiz', function () {
    Mail::fake();

    $data = [
        'name' => 'Team Awesome',
        'contact_name' => 'John Doe',
        'team_size' => 4,
        'email' => 'team@example.com',
    ];

    $response = $this->withoutMiddleware()->post('/', $data);

    $response->assertRedirect('/');
    $response->assertSessionHas('success');

    assertDatabaseHas('quiz_registrations', $data);

    Mail::assertQueued(QuizRegistrationConfirmation::class, function ($mail) use ($data) {
        return $mail->hasTo($data['email'])
            && $mail->hasCc('s.james@muzee.nl')
            && $mail->registration->name === $data['name'];
    });
});

test('name is required', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'contact_name' => 'John Doe',
        'team_size' => 4,
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['name']);
});

test('contact name is required', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'team_size' => 4,
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['contact_name']);
});

test('team size is required', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['team_size']);
});

test('email is required', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 4,
    ]);

    $response->assertInvalid(['email']);
});

test('email must be valid', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 4,
        'email' => 'not-an-email',
    ]);

    $response->assertInvalid(['email']);
});

test('team size must be at least 1', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 0,
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['team_size']);
});

test('team size must not exceed 8', function () {
    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 9,
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['team_size']);
});

test('registration is rejected when total capacity would exceed 75', function () {
    QuizRegistration::factory()->create(['team_size' => 70]);

    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 6,
        'email' => 'test@example.com',
    ]);

    $response->assertInvalid(['team_size']);
});

test('registration is accepted when capacity is exactly reached', function () {
    Mail::fake();

    QuizRegistration::factory()->create(['team_size' => 71]);

    $response = $this->withoutMiddleware()->post('/', [
        'name' => 'Team Name',
        'contact_name' => 'John Doe',
        'team_size' => 4,
        'email' => 'test@example.com',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('success');
});

test('remaining spots are calculated correctly', function () {
    QuizRegistration::factory()->create(['team_size' => 10]);
    QuizRegistration::factory()->create(['team_size' => 15]);

    $response = $this->get('/');

    $response->assertInertia(fn ($page) => $page
        ->where('remainingSpots', 35)
    );
});
