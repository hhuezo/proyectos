<?php

namespace App;

use App\Estado;

use Illuminate\Database\Eloquent\Model;

class ProyectoHistorial extends Model
{
    //
    protected $table = 'proyectos_historial';

    protected $fillable = ['proyecto_id', 'users_id', 'nombre', 'descripcion', 'estado_id', 'destacado'];


    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }


    public function usuario(){
        return $this->belongsTo('App\User', 'users_id', 'id');
    }

}
