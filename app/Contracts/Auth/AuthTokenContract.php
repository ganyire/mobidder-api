<?php

namespace App\Contracts\Auth;

interface AuthTokenContract
{
  public function generateToken(): string;
}
