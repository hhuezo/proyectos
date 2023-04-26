<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDsbDato extends Model
{
    
    //
    protected $table = 'tmp_dsb_datos';

    protected $fillable = ['numero_tickets_anterior', 'numero_tickets_actual', 'numero_incremento_prod', 'numero_proyectos_desarrollo'];
}
