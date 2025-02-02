<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'photo',
    ];

    public function description()
    {
        return $this->hasOne(Description::class,  'location_id');
    }
    public function campaign()
    {
        return $this->belongsToMany(Campaign::class, 'locations_campaigns', 'location_id', 'campaigns_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'locations_services', 'location_id', 'service_id');
    }
}
