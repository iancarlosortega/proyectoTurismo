<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            //Llave foranea con la tabla lugares_turisticos
            $table->unsignedBigInteger('lugar_id');
            $table->foreign('lugar_id')->references('id')->on('lugares_turisticos')->onDelete('cascade');
            
            $table->date('fecha');
            $table->integer('checkins');
            $table->integer('checkouts');
            $table->integer('pernoctaciones');
            $table->integer('nacionales');
            $table->integer('extranjeros');
            $table->integer('habitaciones_ocupadas');
            $table->integer('habitaciones_disponibles');
            $table->string('tipo_tarifa');
            $table->double('tarifa_promedio');
            $table->double('TAR_PER');
            $table->double('ventas_netas');
            $table->double('porcentaje_ocupacion');
            $table->double('revpar');
            $table->integer('empleados_temporales');
            $table->string('estado');
            $table->string('opciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
