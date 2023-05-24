<?php

use App\Notifications\Auth\EmailVerificationCodeNotification;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\postJson;

/**
 * Test if users can sent email verification code to their registered email
 * assert that the email verification code is sent to the user's email.
 */
test('users can sent email verification code to the registered email', function () {
    Notification::fake();
    $user = createUser();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/auth/send-email-verification-code");

    Notification::assertSentTo(
        $user,
        EmailVerificationCodeNotification::class,
        fn ($notification) => $notification->verificationCode == $user->fresh()->email_verification_token
    );
    $response->assertStatus(200);
});

/**
 * Card number: 5321621185253626
 * CVV: 266
 * EXP: 0424CCCCNN
 */
