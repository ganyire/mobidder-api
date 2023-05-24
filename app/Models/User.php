<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Contracts\Auth\AuthTokenContract;
use App\Contracts\Auth\VerifyEmailContract;
use App\Traits\Auth\AuthTokenTrait;
use App\Traits\Auth\VerifyEmailTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class User extends Authenticatable implements VerifyEmailContract, LaratrustUser, AuthTokenContract
{
    use HasRolesAndPermissions;
    use HasApiTokens, HasFactory, Notifiable, HasUlids, SoftDeletes;
    use VerifyEmailTrait, AuthTokenTrait;


    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'locked' => "bool",
    ];

    protected $appends = [
        'role',
    ];

    /**
     * ** MUTATORS AND SETTERS ************************************************
     * ************************************************************************ 
     */

    /**
     * Encrypt the user's password before saving it to the database.
     */
    protected function password(): Attribute
    {
        return Attribute::set(fn ($value) => bcrypt($value));
    }

    /**
     * Get the user's role.
     */
    protected function role(): Attribute
    {
        return Attribute::get(fn () => $this->roles()->first(['name', 'display_name', 'description']));
    }


    /**
     * ** RELATIONSHIPS *******************************************************
     * ************************************************************************ 
     */


    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
