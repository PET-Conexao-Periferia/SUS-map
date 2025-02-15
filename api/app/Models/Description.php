<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Description extends Model
{
    protected $primaryKey = 'location_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'contact',
        'id_openingTimes',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function openingTimes(): HasMany
    {
        return $this->hasMany(OpeningTimes::class, 'id_openingTimes');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class,  'description_id');
    }
}
