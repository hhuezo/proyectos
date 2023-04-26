<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrioridadTicket extends Model
{
    //
    protected $table = 'prioridad_tickets';
    
    protected $fillable = ['nombre'];
}
