<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAdministrativa extends Model
{
    //
    protected $table = 'area_administrativa';

    protected $fillable = ['nombre', 'estado', 'color'];
}
