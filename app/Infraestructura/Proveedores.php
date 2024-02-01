<?php

namespace App\infraestructura;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey = 'id';


     public $timestamps = false;

     protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'producto',
        'activo',
        'fecha_ingreso',
        'fecha_desarrollo',
        'usuario_ingreso',
        'usuario_modifica',
     ];
     protected $guarded = [];
     public function proveedor_eval()
    {
        return $this->belongsTo(EvaluacionProveedor::class, 'proveedor_id');
      }

}
