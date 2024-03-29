<?php

namespace App\snipeit;

use Illuminate\Database\Eloquent\Model;

class VmMantenimiento extends Model
{
    protected $connection = 'mysql2';

    public $timestamps=false;
    protected $table = 'vw_mantenimiento_xsuc';
    protected $fillable = [
        'fecha', 'sucursal', 'area', 'categoria', 'estado', 'nombre_tecnico', 'total'
    ];

    protected $guarded =[];
}
