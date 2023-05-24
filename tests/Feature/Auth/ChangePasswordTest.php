<?php

use Laravel\Sanctum\Sanctum;
use Tests\RequestFactories\ChangePasswordRequestFactory;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertCredentials;
use function Pest\Laravel\assertInvalidCredentials;
use function Pest\Laravel\postJson;

/**
 * test if users can change their password.
 * assert that the password is updated.
 * assert that the user can login with the new password.
 * assert that the user cannot login with the old password.
 */
test('users can change password', function () {
    $oldPassword = 'Oldpass@007';
    $newPassword = 'Newpass@007';
    $user = createUser([
        'password' => $oldPassword,
    ]);
    ChangePasswordRequestFactory::new([
        'oldPassword' => $oldPassword,
        'password' => $newPassword,
    ])->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/auth/change-password");

    $response->assertStatus(200);
    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $oldPassword,
    ], 'web');
    assertCredentials([
        'email' => $user->email,
        'password' => $newPassword,
    ], 'web');
});

/**
 * test if users cannot change their password if they provide wrong old password.
 * assert that the password is not updated.
 * assert that the user cannot login with the new password.
 * assert that the user can login with the old password.
 */
test('users cannot change password if they provide wrong old password', function () {
    $oldPassword = 'Oldpass@007';
    $newPassword = 'Newpass@007';
    $user = createUser([
        'password' => $oldPassword,
    ]);
    ChangePasswordRequestFactory::new([
        'oldPassword' => 'wrong-password',
        'password' => $newPassword,
    ])->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/auth/change-password");

    $response->assertStatus(422);
    $response->assertJsonValidationErrorFor('oldPassword');
    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $newPassword,
    ], 'web');
    assertCredentials([
        'email' => $user->email,
        'password' => $oldPassword,
    ], 'web');
});
