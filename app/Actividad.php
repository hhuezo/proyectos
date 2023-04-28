<?php

namespace App;
use App\Proyecto;
use App\Comentario;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $table = 'actividades';

    protected $fillable = ['numero_ticket','descripcion','fecha_inicio','fecha_fin','porcentaje',
                            'fecha_asignacion', 'fecha_liberacion','proyecto_id','users_id',
                            'estado_id','categoria_id','prioridad_id','ponderacion','contenido','forma','unidad_id'];

    public function proyecto(){
        return $this->belongsTo('App\Proyecto');
    }

    public function prioridad(){
        return $this->belongsTo('App\PrioridadTicket');
    }

    public function estado(){
        return $this->belongsTo('App\Estado', 'estado_id', 'id');
    }

    public function comentarios(){
        //dd($this->hasMany('App\Comentario')->whereNull('parent_id'));
        return $this->hasMany('App\Comentario')->whereNull('parent_id');
    }

    public function usuario(){
        return $this->belongsTo('App\User', 'users_id', 'id');
    }


}
