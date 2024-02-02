<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaActividad extends Model
{
    //
    protected $table = 'area_actividad';

    public $timestamps = false;

    protected $fillable = ['id', 'area_id', 'actividad_id'];

    public function area(){
        return $this->belongsTo('App\AreaAdministrativa', 'area_id', 'id');
    }
}
