<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'startTime',
        'endTime',
    ];

    public function location()
    {
        return $this->belongsToMany(Location::class);
    }
}
