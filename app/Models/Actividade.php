<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tipo_actividad',
        'calorias_quemadas',
        'duracion_minutos'
    ];
}
