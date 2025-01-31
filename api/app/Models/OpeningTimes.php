<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningTimes extends Model
{
    protected $fillable = [
        'day',
        'startTime',
        'endTime',
    ];

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function description()
    {
        return $this->hasMany(Description::class);
    }
}
