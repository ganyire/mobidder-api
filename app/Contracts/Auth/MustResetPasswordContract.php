<?php

namespace App\Contracts\Auth;

use App\Models\PasswordResetToken;
use App\Models\User;

interface MustResetPasswordContract
{

  public function createResetToken(string $email): string;

  public function deleteResetToken(): bool|null;

  public function sendPasswordResetTokenNotification(User $user): void;
}
