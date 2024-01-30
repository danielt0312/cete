<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{


    protected $casts = [
        'periodo_inicio' => 'date',
        'periodo_final' => 'date',
    ];
}
