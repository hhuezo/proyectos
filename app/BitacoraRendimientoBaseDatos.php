<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraRendimientoBaseDatos extends Model
{
    //
    protected $table = 'bitacora_rendimiento_base_datos';

    protected $fillable = [
        'id_excell',
        'fecha',
        'hora',
        'tiempo',
        'tipo_reporte',
        'unidad',
        'programa',
        'referencia',
        'evento',
        'accion_ejecutada',
        'diagnostico',
        'responsable',
        'created_at',
        'updated_at',
        'fecha_ymd',
        'estado_rendimiento_id',
    ];
}
