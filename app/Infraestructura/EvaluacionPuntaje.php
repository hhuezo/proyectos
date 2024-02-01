<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPuntaje extends Model
{
    protected $table = 'evaluacion_puntaje';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'categoria',
        'aceptado',
        'limite_inferior',
        'limite_superior',
        'fecha_ingreso',
        'fecha_modificacion',
        'usuario_ingreso',
        'usuario_modifica',
    ];
    protected $guarded = [];
}
