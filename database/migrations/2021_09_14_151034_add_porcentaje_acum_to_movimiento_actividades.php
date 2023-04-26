<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPorcentajeAcumToMovimientoActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimiento_actividades', function (Blueprint $table) {
            //
            $table->decimal('porcentaje_acum',5,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimiento_actividades', function (Blueprint $table) {
            //
            $table->dropColumn(
                [
                  'porcentaje_acum'
                ]);
        });
    }
}
