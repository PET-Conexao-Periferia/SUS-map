<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model{
    protected $primaryKey = 'description_id';
    protected $fillable = [
        'street',
        'number',
        'district',
        'cep',
        'reference',
        'description_id'
    ];
    public $incrementing = false;
    
    public function description(): BelongsTo {
        return $this->belongsTo(Description::class,'description_id');
    }
}

