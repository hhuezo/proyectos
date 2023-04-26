<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpCategoriaFinalizada extends Model
{
    //
            //
            protected $table = 'tmp_categorias_finalizadas';

            protected $fillable = ['id','fecha_inicio','fecha_fin','num_ticket','descripcion','codigo','nombre','fecha_liberacion'];
}
