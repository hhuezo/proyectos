<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpTotDsbActividadFinalizada extends Model
{
    //
    protected $table = 'tmp_tot_dsb_actividades_finalizadas';

    protected $fillable = ['user_name','numero_actividades'];
}
