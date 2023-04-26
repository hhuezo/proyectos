<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpTotDsbActividadFinalizadaUsuarioSemana extends Model
{
    //
    protected $table = 'tmp_actividades_finalizadas_usuario_semana';

    protected $fillable = ['user_name','numero_actividades'];
}
