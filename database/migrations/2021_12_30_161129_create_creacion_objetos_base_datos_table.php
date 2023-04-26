<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreacionObjetosBaseDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creacion_objetos_base_datos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_especialista');	
            $table->string('num_formulario');	
            $table->string('tipo_objeto');	
            $table->string('fecha_creacion');	
            $table->string('funciones');	
            $table->string('nombre_objeto_asignar');
            $table->string('descripcion');
            $table->string('base_datos');	
            $table->string('grants');	
            $table->string('roles');	
            $table->string('synonyms');	
            $table->string('comentario');	
            $table->string('adjunto1');	
            $table->string('adjunto2');	
            $table->string('adjunto3');	
            $table->string('adjunto4');	
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
        Schema::dropIfExists('creacion_objetos_base_datos');
    }
}
