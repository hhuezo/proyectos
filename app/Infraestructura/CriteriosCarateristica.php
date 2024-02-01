<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class CriteriosCarateristica extends Model
{
    protected $table = 'criterios_x_carateristica';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'calificacion',
        'caracteristica_id',
        'activo',
        'fecha_ingreso',
        'fecha_modificacion',
        'usuario_ingreso',
        'usuario_modifica',
    ];
    protected $guarded = [];

    public function criterios()
    {
        return $this->belongsTo(Caracteristicas::class, 'caracteristica_id');
    }

}
