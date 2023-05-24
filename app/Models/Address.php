<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [
        'id'
    ];

    /**
     * ** RELATIONSHIPS *******************************************************
     * ************************************************************************ 
     */

    /**
     * Get the parent addressable model (e.g user, business etc).
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
