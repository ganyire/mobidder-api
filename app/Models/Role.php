<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\Role as LaraRole;

class Role extends LaraRole
{
    use HasFactory, HasUlids, SoftDeletes;

    public $guarded = [];
}
