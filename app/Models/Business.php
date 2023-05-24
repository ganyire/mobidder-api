<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Business extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasUlids, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'logo'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo');
    }

    /**
     * ** MUTATORS AND SETTERS ************************************************
     * ************************************************************************ 
     */
    protected function logo(): Attribute
    {
        return Attribute::get(
            fn () => $this->hasMedia('logo') ? [
                'id' => $this->getFirstMedia('logo')?->id,
                'url' => $this->getFirstMediaUrl('logo'),
            ] : null
        );
    }

    /**
     * ** RELATIONSHIPS *******************************************************
     * ************************************************************************ 
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
