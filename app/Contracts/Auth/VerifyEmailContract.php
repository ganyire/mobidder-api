<?php

namespace App\Contracts\Auth;

interface VerifyEmailContract
{

  /**
   * Determine if the user has verified their email
   */
  public function hasVerifiedEmailAddress(): bool;

  /**
   * Mark the given user's email as verified
   */
  public function markEmailAddressAsVerified(): bool;

  /**
   * Mark user's email as not verified
   */
  public function unverifyEmailAddress(): bool;

  /**
   * Send the email verification notification
   */
  public function sendMailVerificationNotification(?int $code = null): void;

  /**
   * Get the email address that should be used for verification
   */
  public function getEmailAddressForVerification(): string;
}

// DRY 
// KISS
