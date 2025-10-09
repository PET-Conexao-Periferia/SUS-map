<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Description extends Model
{
    protected $primaryKey = 'location_id';
    protected $fillable = [
        'name',
        'contact',
        'location_id'
    ];
    
    public $incrementing = false;

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class,  'description_id');
    }
}
