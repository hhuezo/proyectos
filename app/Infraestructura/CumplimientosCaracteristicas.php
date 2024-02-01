<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class CumplimientosCaracteristicas extends Model
{

    protected $table = 'cumplimientos_x_caracteristicas';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'cumplimiento_id',
        'caracteristica_id',
        'ponderacion',
        'fecha_ingreso',
        'fecha_modificacion',
        'usuario_ingreso',
        'usuario_modifica',
    ];
    protected $guarded = [];

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristicas::class, 'caracteristica_id');
    }
    public function cumplimiento()
    {
        return $this->belongsTo(Cumplimientos::class, 'cumplimiento_id');
    }


}
