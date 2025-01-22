<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

uses(RefreshDatabase::class);

it('registers a new user successfully', function () {
    $payload = [
        'name' => 'John Doe',
        'username' => 'john_doe',
        'email' => 'john@example.com',
        'password' => 'securepassword',
        'password_confirmation' => 'securepassword',
        'bio' => 'I love forums!'
    ];

    $response = $this->postJson('/api/register', $payload);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'user' => [
                    'id',
                    'username',
                    'email',
                    'bio',
                    'created_at',
                    'updated_at'
                ],
                'token'
            ],
            'message',
            'code'
        ]);

    $this->assertDatabaseHas('users', [
        'username' => 'john_doe',
        'email' => 'john@example.com'
    ]);
});

it('returns validation errors when registering with invalid data', function () {
    $payload = [
        'username' => '',
        'email' => 'invalid-email',
        'password' => '123',
        'bio' => ''
    ];

    $response = $this->postJson('/api/register', $payload);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['username', 'email', 'password']);
});

it('logs in a user successfully', function () {
    User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('securepassword'),
    ]);

    $payload = [
        'email' => 'john@example.com',
        'password' => 'securepassword'
    ];

    $response = $this->postJson('/api/login', $payload);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'token'
            ],
            'message',
            'code'
        ]);
});

it('returns an error when logging in with invalid credentials', function () {
    User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('securepassword'),
    ]);

    $payload = [
        'email' => 'john@example.com',
        'password' => 'wrongpassword'
    ];

    $response = $this->postJson('/api/login', $payload);

    $response->assertStatus(401)
        ->assertExactJson([
            'message' => 'Unauthenticated.'
        ]);
});
