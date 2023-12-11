<?php

namespace App\snipeit;

use Illuminate\Database\Eloquent\Model;

class VmFrecuenciaMantenimiento extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'vw_frecuencia_mttos';

    //protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'nombre_activo',
        'categoria',
        'modelo',
        'sucursal',
        'area',
        'total'
    ];

    protected $guarded = [];
}
