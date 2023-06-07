<?php

use App\Models\User;
use App\Notifications\CredentialsNotification;
use Illuminate\Support\Facades\Notification;
use Tests\RequestFactories\RegisterUserRequestFactory;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\postJson;

/**
 * Test if a new user can create account
 * assert that the user is authenticated
 */
test('new users can register', function () {
    Notification::fake();
    RegisterUserRequestFactory::new()->withRole('vendor')->withAddress()->fake();

    $response = postJson("{$this->baseUrl}/auth/register");

    $notifiable = User::find($response->json('payload.id'));
    Notification::assertSentTo(
        $notifiable,
        CredentialsNotification::class,
    );
    $response->assertStatus(201);
    $response->assertJsonPath('payload.role.name', 'vendor');
    $response->assertJsonPath('payload.token', fn ($token) => !is_null($token));
    assertAuthenticated();
    assertDatabaseCount('users', 1);
});

/**
 * Test if a new user can not create account with invalid data
 * assert that the user is not authenticated
 */
test('users cannot register with invalid data', function () {
    RegisterUserRequestFactory::new(['email' => 'invalid-email'])->fake();

    $response = postJson("{$this->baseUrl}/auth/register");

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['email']);
    assertDatabaseEmpty('users');
    assertGuest();
});
