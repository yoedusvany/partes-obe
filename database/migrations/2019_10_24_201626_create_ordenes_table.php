<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('no_serie');
            $table->date('fecha');
            $table->string('cliente');
            $table->string('dir');
            $table->boolean('ejecutado');
            $table->date('fecha_ejecucion');
            $table->bigInteger('sucursales_id');
            $table->bigInteger('services_id');
            $table->timestamps();

            $table->foreign('sucursales_id')->references('id')->on('sucursales');
            $table->foreign('services_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
