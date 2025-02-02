<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
    ];

    public function location()
    {
        return $this->belongsToMany(Location::class, 'locations_services', 'location_id', 'service_id');
    }
    public function openingTimes()
    {
        return $this->hasOne(OpeningTimes::class, 'openingTimes_id');
    }
}
