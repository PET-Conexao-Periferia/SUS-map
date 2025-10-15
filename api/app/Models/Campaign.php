<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'startTime',
        'endTime'
    ];

    public function locations()
    {
        return $this->belongsToMany(
            Location::class,
            'locations_campaigns',  // nome correto da tabela pivot
            'campaigns_id',         // nome da coluna que referencia Campaign
            //'location_id'           // nome da coluna que referencia Location
        );
    }
    
}
