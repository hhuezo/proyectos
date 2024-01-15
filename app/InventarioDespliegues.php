<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioDespliegues extends Model
{
    protected $table = 'inventario_despliegues';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ip',
        'nombre',
        'conocido_por',
        'tipo_de_servidor',
        'version_servidor',
        'ambiente',
        'war_instalado',
        'proyecto',
        'puerto',
        'virtualizacion',
        'endpoint'
    ];

    protected $guarded = [];
}
