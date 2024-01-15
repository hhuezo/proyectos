<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreacionObjetoBase extends Model
{
    //
    protected $table = 'creacion_objeto_base_datos';

    protected $fillable = [
        'nombre_especialista',
        'num_formulario',
        'tipo_objeto',
        'fecha_creacion',
        'funciones',
        'nombre_objeto_asignar',
        'descripcion',
        'base_datos',
        'grants',
        'roles',
        'synonyms',
        'comentario',
        'adjunto1',
        'adjunto2',
        'adjunto3',
        'adjunto4',
        'proyecto_relacionado'
  ];
}
