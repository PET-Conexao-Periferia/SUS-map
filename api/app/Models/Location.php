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

    public function campaign()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function description()
    {
        return $this->hasOne(Description::class,  'id_location');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
