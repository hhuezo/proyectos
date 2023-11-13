<?php

namespace App\snipeit;

use Illuminate\Database\Eloquent\Model;

class ActivosIso extends Model
{
    protected $connection = 'mysql2';

    public $timestamps=false;
    protected $table = 'activos_iso';
    protected $fillable = [
        'nombre_activo', 'categoria', 'sucursal_std', 'area', 'status', 'fecha_compra'
    ];

    protected $guarded =[];
}
