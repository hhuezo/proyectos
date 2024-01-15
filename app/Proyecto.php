<?php

namespace App;
use App\Actividad;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $table = 'proyectos';

    protected $fillable = ['nombre','descripcion','estado_id','destacado','unidad_id'];

    public function actividades(){
        return $this->hasMany('App\Actividad');
    }

}
