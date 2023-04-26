<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Proyecto;
use App\Actividad;
use App\Comentario;
use App\User;

class Comentario extends Model
{
    //
    protected $fillable = [
        'descripcion', 'parent_id', 'actividad_id', 'users_id', 'estado'
    ];

    public function actividad(){
        return $this->belongsTo('App\Actividad');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function parent(){
        return $this->belongsTo('App\Comentario','parent_id');
    }

    public function respuestas(){
        return $this->hasMany('App\Comentario','parent_id');
    }
}
