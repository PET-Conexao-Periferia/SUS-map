<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $primaryKey = 'location_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'contact',
        'id_openingTimes',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function openingTimes()
    {
        return $this->hasOne(OpeningTimes::class, 'id_openingTimes');
    }

    public function address()
    {
        return $this->hasOne(Address::class,  'description_id');
    }
}
