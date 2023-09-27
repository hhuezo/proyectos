<?php

namespace App\catalogo;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietario';

    protected $primaryKey = 'id';


     public $timestamps = false;

     protected $fillable = [
         'nombre',
         'activo',

     ];
}
