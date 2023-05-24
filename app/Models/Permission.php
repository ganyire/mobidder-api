<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\Permission as LaraPermission;

class Permission extends LaraPermission
{
    use HasFactory, HasUlids, SoftDeletes;

    public $guarded = [];
}
