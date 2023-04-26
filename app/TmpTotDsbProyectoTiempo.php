<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpTotDsbProyectoTiempo extends Model
{
    //
    protected $table = 'tmp_tot_dsb_proyectos_tiempo';

    protected $fillable = ['proyecto','tiempo'];
}
