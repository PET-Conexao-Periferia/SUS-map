<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'id_location',
        'id_openingTimes',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }

    public function openingTimes()
    {
        return $this->hasOne(OpeningTimes::class, 'id_openingTimes');
    }
}
