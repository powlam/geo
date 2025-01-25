<?php

declare(strict_types=1);

use App\Models\User;

it('can register', function (): void {
    expect(User::count())->toBe(0);

    $response = $this->post('/api/register', [
        'name' => 'My name',
        'email' => 'email@test.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200);
    expect(User::count())->toBe(1);
});

it('can login', function (): void {
    $user = User::factory(state: ['password' => 'pass'])->create()->fresh();

    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'pass',
    ]);

    $response->assertStatus(200);
    $jsonResponse = json_decode($response->content());
    expect($jsonResponse->message)->toBe('Authenticated');
    expect($jsonResponse->statusCode)->toBe(200);
    expect($jsonResponse->data->token)->not->toBeNull();
});

it('cannot login with invalid credentials', function (): void {
    User::factory(state: ['email' => 'good@email.com', 'password' => 'pass'])->create()->fresh();

    $response = $this->post('/api/login', [
        'email' => 'bad@email.com',
        'password' => 'pass',
    ]);

    $response->assertStatus(200);
    expect($response->content())->toBe('{"errors":[{"message":"Unauthorized","status":401}]}');

    $response = $this->post('/api/login', [
        'email' => 'good@email.com',
        'password' => 'asdf',
    ]);

    $response->assertStatus(200);
    expect($response->content())->toBe('{"errors":[{"message":"Unauthorized","status":401}]}');
});

it('can logout', function (): void {
    $user = User::factory(state: ['password' => 'pass'])->create()->fresh();

    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'pass',
    ]);
    $bearerToken = json_decode($response->content())->data->token;

    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$bearerToken,
    ])->post('/api/logout');

    $response->assertStatus(200);
    expect($response->content())->toBe('{"message":"Logged out!","statusCode":200,"data":[]}');
});
