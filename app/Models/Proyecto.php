<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public $timestamps = false;
    protected $casts = [
        'periodo_inicio' => 'date',
        'periodo_final' => 'date',
    ];
}
