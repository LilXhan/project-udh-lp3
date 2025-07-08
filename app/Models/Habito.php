<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alimento_id',
        'actividad_id',
        'valor'
    ];

    /**
     * Obtiene el usuario al que pertenece este hábito
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el alimento asociado a este hábito
     */
    public function alimento()
    {
        return $this->belongsTo(Alimento::class);
    }

    /**
     * Obtiene la actividad asociada a este hábito
     */
    public function actividad()
    {
        return $this->belongsTo(Actividade::class);
    }
}
