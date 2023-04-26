<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDsbProyecto extends Model
{
    //
        //
        protected $table = 'tmp_dsb_proyectos';

        protected $fillable = ['id', 'nombre', 'descripcion', 'estado_id', 'destacado', 'avance'];
}
