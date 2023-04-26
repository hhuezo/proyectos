<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificacionObjetoSistema extends Model
{
    //

    protected $table = 'certificacion_objetos_sistema';

    protected $fillable = [  
        'formulario_a_cetificar',
        'fecha_desarrollo',
        'programas_a_certificar',
        'versiones_a_certificar',
        'consideraciones_para_certificar',
        'conexion_base_datos',
        'ruta_acceso',
        'instrucciones_apoyo',
        'equipo_especifico_para_certificar',
        'recibido_para_certificacion',
        'responsable_certificacion',
        'referencia_prueba',
        'descripcion_prueba',
        'resultados_prueba',
        'observaciones_comentarios',
        'fecha_observaciones_go',
        'observaciones_go',
        'fecha_certificacion',
        'resultado_general_certificacion',
        'correlativo_certificacion'
  ];

}
