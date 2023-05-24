<?php

namespace App\Traits\Auth;

use App\Models\PasswordResetToken;
use App\Models\User;
use App\Notifications\Auth\PasswordResetCodeNotification;

trait MustResetPasswordTrait
{

  /**
   * Create a new password reset token
   */
  public function createResetToken(string $email): string
  {
    $resetToken = rand(100000, 999999);
    $tokenRecord = $this->query()->updateOrCreate(
      ['email' => $email],
      ['token' => $resetToken, 'created_at' => now()]
    );

    return $tokenRecord->token;
  }


  /**
   * Delete a password reset token
   */
  public function deleteResetToken(): bool|null
  {
    return $this->delete();
  }

  /**
   * Send password reset token notification
   */
  public function sendPasswordResetTokenNotification(User $user): void
  {
    $token = $this->createResetToken($user->email);
    $user->notify(new PasswordResetCodeNotification($token));
  }
}
