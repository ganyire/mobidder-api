<?php

use App\Notifications\Auth\PasswordResetCodeNotification;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\postJson;

/**
 * test if users can request password reset token
 * assert that the password reset token is created.
 * assert that the password reset token is sent to the user's email.
 */
test('users can request password reset token', function () {
    Notification::fake();
    $email = fake()->safeEmail();
    $user = createUser(attributes: [
        'email' => $email
    ]);

    $response = postJson("{$this->baseUrl}/auth/send-password-reset-code", [
        'email' => $email
    ]);

    Notification::assertSentTo($user, PasswordResetCodeNotification::class);
    $response->assertStatus(200);
    assertDatabaseCount('password_reset_tokens', 1);
});
