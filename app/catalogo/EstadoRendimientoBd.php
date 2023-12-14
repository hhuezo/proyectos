<?php

namespace App\catalogo;

use Illuminate\Database\Eloquent\Model;

class EstadoRendimientoBd extends Model
{
    protected $table = 'estados_rendimiento_bda';

    protected $primaryKey = 'id';


     public $timestamps = false;

     protected $fillable = [
         'nombre',
     ];
}
