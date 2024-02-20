<?php

namespace App\infraestructura;

use App\User;
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
'estado',
    ];
    public function user_vacacion()
    {
      
        return $this->belongsTo(User::class,'id');
    }
    protected $guarded = [];

     

}
