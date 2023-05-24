<?php

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\postJson;

/**
 * Test if a user can login
 * assert that the user is authenticated
 */
test('users can log in', function () {
    $password = 'Lenny@007';
    $user = createUser(attributes: [
        'email' => 'leonard.ganyire@app.com',
        'password' => $password,
    ], role: 'vendor-admin');

    $response = postJson("{$this->baseUrl}/auth/login", [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath('payload.token', fn ($token) => !is_null($token));
    assertAuthenticated();
});

/**
 * Test if a user can not login with invalid credentials
 * assert that the user is not authenticated
 */
test('users cannot log in with invalid credentials', function () {
    $password = 'Lenny@007';
    $user = createUser(attributes: [
        'email' => 'leonard.ganyire@app.com',
        'password' => $password,
    ], role: 'vendor-admin');

    $response = postJson("{$this->baseUrl}/auth/login", [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(401);
    $response->assertJsonPath('payload', null);
    assertGuest();
});
