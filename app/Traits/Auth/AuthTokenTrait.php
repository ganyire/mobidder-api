<?php

namespace App\Traits\Auth;

trait AuthTokenTrait
{

  public function generateToken(): string
  {
    // $expiresAt = now()->addMinutes(config('sanctum.expiration'));
    $device = substr(request()->userAgent() ?? '', 0, 255);
    $token = $this->createToken(name: $device)->plainTextToken;
    return $token;
  }

  public function token()
  {
    return $this->tokens()->first();
  }
}
