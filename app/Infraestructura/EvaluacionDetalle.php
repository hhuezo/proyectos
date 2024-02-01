<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDetalle extends Model
{

    protected $table = 'evaluacion_detalle';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'evaluacion_id',
        'cumplimiento_car_id',
        'criterio_caracteristica_id',
        'ingreso',
    ];
    protected $guarded = [];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionProveedor::class, 'evaluacion_id');
    }

    public function cumplimiento_caracteristica()
    {
        return $this->belongsTo(CumplimientosCaracteristicas::class, 'cumplimiento_car_id');
    }
    public function criterios_caraceritisticas()
    {
        return $this->belongsTo(CriteriosCarateristica::class, 'caracteristica_id');
        //CriteriosCarateristica
    }



}
