<?php

use App\Notifications\Auth\EmailVerificationCodeNotification;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\postJson;

/**
 * Test if users verify their email address using verification code sent to them
 */
test('users can verify email address using verification token sent to them', function () {
    Notification::fake();
    $user = createUser();

    Sanctum::actingAs($user);
    postJson("{$this->baseUrl}/auth/send-email-verification-code");

    Notification::assertSentTo(
        $user,
        EmailVerificationCodeNotification::class,
        function ($notification) use ($user) {
            Sanctum::actingAs($user);
            $response = postJson("{$this->baseUrl}/auth/verify-email-address", [
                'email_verification_token' => $notification->verificationCode
            ]);
            $response->assertStatus(200);
            return true;
        }
    );
});
