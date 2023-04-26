<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificacionObjetosSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificacion_objetos_sistema', function (Blueprint $table) {
            $table->id();
            $table->string('formulario_a_cetificar');
            $table->string('fecha_desarrollo');
            $table->string('programas_a_certificar');
            $table->string('versiones_a_certificar');
            $table->text('consideraciones_para_certificar');
            $table->string('conexion_base_datos');
            $table->string('ruta_acceso');
            $table->text('instrucciones_apoyo');
            $table->string('equipo_especifico_para_certificar');
            $table->string('recibido_para_certificacion');
            $table->string('responsable_certificacion');
            $table->text('referencia_prueba');
            $table->text('descripcion_prueba');
            $table->text('resultados_prueba');
            $table->text('observaciones_comentarios');
            $table->string('fecha_observaciones_go');
            $table->text('observaciones_go');
            $table->string('fecha_certificacion');
            $table->text('resultado_general_certificacion');
            $table->string('correlativo_certificacion');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificacion_objetos_sistema');
    }
}
