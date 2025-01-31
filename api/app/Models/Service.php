<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
    ];

    public function openingTimes()
    {
        return $this->hasOne(OpeningTimes::class, 'id_openingTimes');
    }
}
