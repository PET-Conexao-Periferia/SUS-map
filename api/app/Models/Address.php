<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model{
    protected $primaryKey = 'description_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'cep',
        'reference',
    ];

    public function description() {
        return $this->belongsTo(Description::class,'description_id');
    }
}

    