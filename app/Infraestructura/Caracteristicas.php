<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class Caracteristicas extends Model
{
    protected $table = 'caracteristicas';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'activo',
        'fecha_ingreso',
        'fecha_modificacion',
        'usuario_ingreso',
        'usuario_modifica',
    ];
    public function cumplimiento_caracteristica()
    {
        return $this->hasMany(Cumplimientoscaracteristicas::class,'caracteristica_id');
    }
    public function criterios()
    {
        return $this->hasMany(CriteriosCarateristica::class, 'caracteristica_id');
    }




    protected $guarded = [];


}
