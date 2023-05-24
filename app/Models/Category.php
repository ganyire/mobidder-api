<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUlids;

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'slug',
    ];

    /**
     * ** MUTATORS AND SETTERS ************************************************
     * ************************************************************************ 
     */

    public function slug(): Attribute
    {
        return Attribute::get(fn () => strtolower(str_replace(' ', '-', $this->name)));
    }

    /**
     * ** RELATIONSHIPS *******************************************************
     * ************************************************************************ 
     */

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
