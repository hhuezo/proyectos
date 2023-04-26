<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDsbActividadDiaria extends Model
{
    //
    protected $table = 'tmp_tot_dsb_actividades_diarias';

    protected $fillable = ['dia','numero_actividades'];
}
