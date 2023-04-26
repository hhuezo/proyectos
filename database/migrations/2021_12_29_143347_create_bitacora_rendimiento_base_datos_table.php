<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraRendimientoBaseDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_rendimiento_base_datos', function (Blueprint $table) {
            $table->id();
            $table->string('id_excell');	
            $table->string('fecha');	
            $table->string('hora');	
            $table->string('tiempo');
            $table->string('tipo_reporte');
            $table->string('unidad');	
            $table->string('programa');	
            $table->string('referencia');	
            $table->string('evento');	
            $table->string('accion_ejecutada');
            $table->string('diagnostico');	
            $table->string('responsable');
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
        Schema::dropIfExists('bitacora_rendimiento_base_datos');
    }
}
