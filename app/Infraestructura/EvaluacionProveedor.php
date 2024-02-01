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
