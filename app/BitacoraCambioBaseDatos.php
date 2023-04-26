<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraCambioBaseDatos extends Model
{
    //
    protected $table = 'bitacora_cambio_base_datos';

    protected $fillable = [  
    'num_excell',
    'esquema',
    'objeto_creado_cambiado',
    'objeto_referencia',
    'uso_negocio',
    'accion',
    'fecha_implementacion',
    'origen_cambio',
    'observacion'
  ];
}
