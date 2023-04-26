<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpTotDsbActividad extends Model
{
        //
        protected $table = 'tmp_tot_dsb_actividades';

        protected $fillable = ['user_name','numero_actividades'];
}
