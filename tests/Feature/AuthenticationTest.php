<?php

test('web registration is disabled', function () {
    $response = $this->get('/register');

    $response->assertNotFound();
});

test('web registration POST endpoint is disabled', function () {
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'SecurePassword123!',
        'password_confirmation' => 'SecurePassword123!',
    ]);

    $response->assertNotFound();
});

test('login page does not show registration link', function () {
    $response = $this->get('/login');

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page
        ->component('auth/login')
        ->missing('canRegister')
    );
});
