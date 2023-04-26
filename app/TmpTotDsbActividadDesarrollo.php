<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpTotDsbActividadDesarrollo extends Model
{
    //
    protected $table = 'tmp_dsb_actividades_desarrollo';

    protected $fillable = ['user_name','numero_actividades'];
}
