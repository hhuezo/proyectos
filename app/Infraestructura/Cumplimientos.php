<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class Cumplimientos extends Model
{
    protected $table = 'cumplimientos';

    protected $primaryKey = 'id';


     public $timestamps = false;

     protected $fillable = [
        'nombre',
        'activo',
        'fecha_ingreso' ,
        'fecha_modificacion' ,
        'usuario_ingreso',
        'usuario_modifica' ,
     ];
     protected $guarded = [];



        public function cumplimiento_has_caracteristica()
        {
            return $this->hasMany(CumplimientosCaracteristicas::class, 'cumplimiento_id');

        }

    public function getCaracteristicas($id)
    {
        $array_id = CumplimientosCaracteristicas::where('cumplimiento_id','=',$id)->pluck('caracteristica_id')->toArray();

        $caracteristicas = Caracteristicas::whereIn('id', $array_id)->get();

        return $caracteristicas;
    }



}
