<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDsbActividadActual extends Model
{
    //
        //
        protected $table = 'tmp_dsb_actividades_actuales';

        protected $fillable = ['user_name','name','actividad','cuenta','avance'];
}
