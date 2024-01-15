<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaTicket extends Model
{
    //
    protected $table = 'categoria_tickets';

    protected $fillable = ['codigo','nombre','unidad_id'];
}
