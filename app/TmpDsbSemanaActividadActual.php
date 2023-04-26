<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDsbSemanaActividadActual extends Model
{
    //
    protected $table = 'tmp_dsb_semana_actividades_actuales';

    protected $fillable = ['semana','numero_actividades'];
}
