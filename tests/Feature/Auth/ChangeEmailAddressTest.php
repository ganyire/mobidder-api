<?php

use Laravel\Sanctum\Sanctum;
use Tests\RequestFactories\ChangeEmailAddressRequestFactory;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertCredentials;
use function Pest\Laravel\assertInvalidCredentials;
use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertTrue;



/**
 * test if users can change their email address.
 * assert that the email address is updated.
 * assert that the user can login with the new email address.
 * assert that the user cannot login with the old email address.
 * assert email is set to unverified after email address is changed.
 * assert email reset token is deleted after email address is changed.
 */
test('users can change email address', function () {

    $oldEmail = 'test1@app.com';
    $newEmail = 'test@app.com';
    $password = fake()->password();
    $user = createUser([
        'email' => $oldEmail,
        'password' => $password,
    ]);
    ChangeEmailAddressRequestFactory::new([
        'email' => $newEmail,
        'password' => $password,
    ])->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/auth/change-email");

    $response->assertStatus(200);
    assertInvalidCredentials([
        'email' => $oldEmail,
        'password' => $password
    ], 'web');
    assertCredentials([
        'email' => $newEmail,
        'password' => $password
    ], 'web');
    assertTrue($user->fresh()->hasVerifiedEmail() === false);
    assertTrue($user->fresh()->email_verification_token === null);
});

/**
 * test if users cannot change their email due to incorrect password.
 * assert email validation error is returned.
 */
test('users cannot change email address due to incorrect password', function () {

    $newEmail = fake()->unique()->safeEmail();
    $password = fake()->password();
    $user = createUser([
        'password' => $password,
    ]);
    ChangeEmailAddressRequestFactory::new([
        'email' => $newEmail,
        'password' => 'wrong-password',
    ])->fake();

    $response = actingAs($user)->postJson("{$this->baseUrl}/auth/change-email");
    $response->assertStatus(422);
    $response->assertJsonValidationErrorFor('password');
});
