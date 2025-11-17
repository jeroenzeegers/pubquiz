<?php

use App\Models\User;

use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('user can be registered via CLI with options', function () {
    artisan('user:register', [
        '--name' => 'John Doe',
        '--email' => 'john@example.com',
        '--password' => 'SecurePassword123!',
    ])
        ->assertSuccessful()
        ->expectsOutput('User [john@example.com] registered successfully!');

    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $user = User::where('email', 'john@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->password)->not->toBe('SecurePassword123!');
});

test('user registration fails when email already exists', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    artisan('user:register', [
        '--name' => 'Jane Doe',
        '--email' => 'existing@example.com',
        '--password' => 'SecurePassword123!',
    ])
        ->assertFailed();
});

test('user registration fails with invalid email', function () {
    artisan('user:register', [
        '--name' => 'Jane Doe',
        '--email' => 'not-an-email',
        '--password' => 'SecurePassword123!',
    ])
        ->assertFailed();
});

test('user registration fails with short password', function () {
    artisan('user:register', [
        '--name' => 'Jane Doe',
        '--email' => 'jane@example.com',
        '--password' => 'short',
    ])
        ->assertFailed();
});

test('user registration fails with empty name', function () {
    artisan('user:register', [
        '--name' => '',
        '--email' => 'jane@example.com',
        '--password' => 'SecurePassword123!',
    ])
        ->assertFailed();
});

test('user email is stored in lowercase', function () {
    artisan('user:register', [
        '--name' => 'John Doe',
        '--email' => 'John@EXAMPLE.COM',
        '--password' => 'SecurePassword123!',
    ])
        ->assertSuccessful();

    assertDatabaseHas('users', [
        'email' => 'john@example.com',
    ]);
});

test('user password is hashed', function () {
    artisan('user:register', [
        '--name' => 'John Doe',
        '--email' => 'john@example.com',
        '--password' => 'SecurePassword123!',
    ])
        ->assertSuccessful();

    $user = User::where('email', 'john@example.com')->first();
    expect($user->password)->not->toBe('SecurePassword123!');
    expect(strlen($user->password))->toBeGreaterThan(50);
});
