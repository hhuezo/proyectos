<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraCambioBaseDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_cambio_base_datos', function (Blueprint $table) {
            $table->id();
            $table->string('num_excell');	
            $table->string('esquema');	
            $table->string('objeto_creado_cambiado');	
            $table->string('objeto_referencia');
            $table->string('uso_negocio');
            $table->string('accion');	
            $table->string('fecha_implementacion');	
            $table->string('origen_cambio');	
            $table->string('observacion');	
            $table->datetime('fecha_ymd');
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
        Schema::dropIfExists('bitacora_cambio_base_datos');
    }
}
