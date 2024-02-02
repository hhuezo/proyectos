<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class EvaluacionProveedor extends Model
{
    protected $table = 'evaluacion_proveedores';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'proveedor_id',
        'fecha_evalua',
        'periodo_evaluacion',
        'user',
        'resultado_id',
        'puntos',
        'notificado',
        'codigo',
        'version',
        'registro',
        'nombre_elaborado',
        'cargo_elaborado',
        'fecha_elaborado',
        'nombre_revisado',
        'cargo_revisado',
        'fecha_revisado',
        'nombre_aprobado',
        'cargo_aprobado',
        'fecha_aprobado',

    ];
    protected $guarded = [];
    public function detalles()
    {
        return $this->hasMany(EvaluacionDetalle::class, 'evaluacion_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
      }

}
