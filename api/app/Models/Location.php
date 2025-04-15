<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'photo',
    ];

    public function description(): HasOne
    {
        return $this->hasOne(Description::class,  'location_id');
    }
    public function campaign(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'locations_campaigns', 'location_id', 'campaigns_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
