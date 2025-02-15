<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'startTime',
        'endTime',
    ];

    public function location(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'locations_campaigns', 'location_id', 'campaigns_id');
    }
}
