<?php

use App\Livewire\Admin\QuizRegistrations;
use App\Models\QuizRegistration;
use App\Models\User;
use Livewire\Livewire;

test('admin quiz registrations page requires authentication', function () {
    $response = $this->get(route('admin.quiz-registrations.index'));

    $response->assertRedirect(route('login'));
});

test('admin quiz registrations page requires verified email', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get(route('admin.quiz-registrations.index'));

    $response->assertRedirect(route('verification.notice'));
});

test('verified admin can view quiz registrations', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.quiz-registrations.index'));

    $response->assertSuccessful();
});

test('admin can delete a registration', function () {
    $user = User::factory()->create();
    $registration = QuizRegistration::factory()->create();

    Livewire::actingAs($user)
        ->test(QuizRegistrations::class)
        ->call('delete', $registration);

    $this->assertDatabaseMissing('quiz_registrations', [
        'id' => $registration->id,
    ]);
});

test('deleting a registration updates the remaining spots', function () {
    $user = User::factory()->create();
    $registration = QuizRegistration::factory()->create(['team_size' => 5]);

    expect(QuizRegistration::sum('team_size'))->toBe(5);

    Livewire::actingAs($user)
        ->test(QuizRegistrations::class)
        ->call('delete', $registration);

    expect(QuizRegistration::sum('team_size'))->toBe(0);
});
