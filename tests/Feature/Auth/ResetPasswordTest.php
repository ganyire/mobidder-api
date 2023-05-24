<?php

use App\Notifications\Auth\PasswordResetCodeNotification;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\assertCredentials;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertInvalidCredentials;
use function Pest\Laravel\postJson;

/**
 * test if users can reset their password. 
 * assert that the password reset token is deleted after the password is reset.
 * assert that the password is updated.
 * assert that the user can login with the new password.
 * assert that the user cannot login with the old password.
 */
test('users can reset their password using correct token', function () {
    $oldPassword = fake()->unique()->password(6) . '@007';
    $newPassword = fake()->unique()->password(6) . '@007';
    Notification::fake();
    $email = fake()->safeEmail();
    $user = createUser(attributes: [
        'email' => $email,
        'password' => $oldPassword
    ]);

    postJson("{$this->baseUrl}/auth/send-password-reset-code", [
        'email' => $email
    ]);

    Notification::assertSentTo(
        $user,
        PasswordResetCodeNotification::class,
        function ($notification) use ($user, $newPassword) {
            $response = postJson("{$this->baseUrl}/auth/reset-password", [
                'email' => $user->email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => $notification->passwordResetCode,
            ]);
            $response->assertStatus(200);
            assertDatabaseEmpty('password_reset_tokens');
            return true;
        }
    );
    assertInvalidCredentials([
        'email' => $email,
        'password' => $oldPassword
    ]);
    assertCredentials([
        'email' => $email,
        'password' => $newPassword
    ]);
});

/**
 * test if users cannot reset their password with a wrong token.
 * assert that the reset token is not deleted after password reset fails.
 * assert that the password is not updated.
 * assert that the user cannot login with the new password.
 * assert that the user can login with the old password.
 */
test("users cannot reset password with a wrong reset token", function () {
    $newPassword = fake()->unique()->password();
    $oldPassword = fake()->unique()->password();
    Notification::fake();
    $email = fake()->safeEmail();
    $user = createUser(attributes: [
        'email' => $email,
        'password' => $oldPassword
    ]);

    postJson("{$this->baseUrl}/auth/send-password-reset-code", [
        'email' => $email
    ]);

    Notification::assertSentTo(
        $user,
        PasswordResetCodeNotification::class,
        function () use ($user, $newPassword) {
            $response = postJson("{$this->baseUrl}/auth/reset-password", [
                'email' => $user->email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => 'wrong-token',
            ]);
            $response->assertStatus(422);
            $response->assertJsonValidationErrorFor('token');
            assertDatabaseCount('password_reset_tokens', 1);
            return true;
        }
    );

    assertInvalidCredentials([
        'email' => $email,
        'password' => $newPassword
    ]);
    assertCredentials([
        'email' => $email,
        'password' => $oldPassword
    ]);
});
