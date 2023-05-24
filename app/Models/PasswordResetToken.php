<?php

namespace App\Models;

use App\Contracts\Auth\MustResetPasswordContract;
use App\Traits\Auth\MustResetPasswordTrait;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordResetToken extends Model implements MustResetPasswordContract
{

    use MustResetPasswordTrait;

    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    public $timestamps = false;
}
