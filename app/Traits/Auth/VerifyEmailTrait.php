<?php

namespace App\Traits\Auth;

use App\Notifications\Auth\EmailVerificationCodeNotification;

trait VerifyEmailTrait
{

  /**
   * Get the email address that should be used for verification.
   */
  public function getEmailAddressForVerification(): string
  {
    return $this->email;
  }

  /**
   * Determine if the user has verified their email address.
   */
  public function hasVerifiedEmailAddress(): bool
  {
    return !is_null($this->email_verified_at);
  }

  /**
   * Mark the given user's email address as verified and clear the token.
   */
  public function markEmailAddressAsVerified(): bool
  {
    return $this->forceFill([
      'email_verified_at' => $this->freshTimestamp(),
      'email_verification_token' => null,
    ])->save();
  }

  /**
   * Mark the given user's email address as not verified and clear the token.
   * This is used when the user changes their email address. We want to force them to verify the new address.
   */
  public function unverifyEmailAddress(): bool
  {
    return $this->forceFill([
      'email_verified_at' => null,
      'email_verification_token' => null,
    ])->save();
  }

  /**
   * Send the email verification notification.
   */
  public function sendMailVerificationNotification(?int $code = null): void
  {
    if ($this->hasVerifiedEmailAddress()) {
      return;
    }
    $verificationCode = $code ?? rand(100000, 999999);
    $this->forceFill([
      'email_verification_token' => $verificationCode,
    ])->save();

    $this->notify(new EmailVerificationCodeNotification($verificationCode));
  }
}
