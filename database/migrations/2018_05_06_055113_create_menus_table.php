<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Menu', function (Blueprint $table) {
            $table->increments('idMenu');
            $table->string('Plato');
            $table->string('Precio');
            $table->string('Disponible');

            $table->integer('idNegocio')->unsigned();

            $table->foreign('idNegocio')->references('idNegocio')->on('LocalNegocio');

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
        Schema::dropIfExists('Menu');
    }
}
