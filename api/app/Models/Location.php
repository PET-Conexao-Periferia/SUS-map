<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

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
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'locations_services');
    }
}
