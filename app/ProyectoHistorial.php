<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoHistorial extends Model
{
      //
      protected $table = 'proyectos_historial';

      protected $fillable = ['proyecto_id','users_id','nombre','descripcion','estado_id','destacado'];
}
