<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            
            $table->dateTime('fecha');
            $table->text('comentario');
            
            $table->unsignedBigInteger('actividad_id')->unsigned()->nullable();
            $table->foreign('actividad_id')->references('id')->on('actividades');

            $table->unsignedBigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');

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
        Schema::dropIfExists('comentarios');
    }
}
