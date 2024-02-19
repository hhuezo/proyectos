<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class CalendarioVacacion extends Model
{

    protected $table = 'calendarizacion_vacaciones';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
       'personal_id',
'area',
'cargo',
'periodo',
'fecha_inicio',
'fecha_final',
'observaciones',
    ];
    protected $guarded = [];
}
