<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoActividad extends Model
{
    //
    protected $table = 'movimiento_actividades';

    protected $fillable = ['fecha','porcentaje','actividad_id','estado_id','porcentaje_acum','detalle','tiempo','tiempo_minutos'];

    public function actividad(){
        return $this->belongsTo('App\Actividad');
    }

}
