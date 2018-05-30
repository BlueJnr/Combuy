<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidomenu', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('cantidad');

            $table->integer('idcliente')->unsigned();
            $table->integer('idmenu')->unsigned();


            $table->foreign('idcliente')->references('id')->on('cliente');
            $table->foreign('idmenu')->references('id')->on('menu');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PedidoMenu');
    }
}
