<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();

            $table->string('numero_ticket');
            $table->string('descripcion');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->decimal('porcentaje',5,2);
            $table->dateTime('fecha_asignacion');
            $table->dateTime('fecha_liberacion')->nullable();

            $table->unsignedBigInteger('proyecto_id')->unsigned()->nullable();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            
            $table->unsignedBigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');

            $table->unsignedBigInteger('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedBigInteger('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categoria_tickets');

            $table->unsignedBigInteger('prioridad_id')->unsigned()->nullable();
            $table->foreign('prioridad_id')->references('id')->on('prioridad_tickets');
            
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
        Schema::dropIfExists('actividades');
    }
}
