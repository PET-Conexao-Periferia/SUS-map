<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpeningTimes extends Model
{
    protected $fillable = [
        'day',
        'startTime',
        'endTime',
    ];

    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function description(): BelongsToMany
    {
        return $this->belongsToMany(Description::class);
    }
}
