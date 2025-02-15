<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model{
    protected $primaryKey = 'description_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'street',
        'number',
        'district',
        'cep',
        'reference',
    ];

    public function description(): BelongsTo {
        return $this->belongsTo(Description::class,'description_id');
    }
}

    