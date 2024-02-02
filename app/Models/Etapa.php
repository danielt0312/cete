<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    public $timestamps = false;
    protected $casts = [
        'fecha_subida_doc' => 'date',
    ];
}
