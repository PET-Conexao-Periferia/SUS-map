<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Service extends Model
{
    protected $fillable = [
        'name',
    ];

    public function location(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'locations_services', 'location_id', 'service_id');
    }
    public function openingTimes(): HasOne
    {
        return $this->hasOne(OpeningTimes::class, 'openingTimes_id');
    }
}
