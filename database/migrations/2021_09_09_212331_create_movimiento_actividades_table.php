<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_actividades', function (Blueprint $table) {
            $table->id();

            $table->dateTime('fecha');
            $table->decimal('porcentaje',5,2);
            
            $table->unsignedBigInteger('actividad_id')->unsigned()->nullable();
            $table->foreign('actividad_id')->references('id')->on('actividades');

            $table->unsignedBigInteger('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            
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
        Schema::dropIfExists('movimiento_actividades');
    }
}
