<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductoStock', function (Blueprint $table) {
            $table->increments('idProductoStock');
            $table->string('stock');
            $table->integer('ProductoLocal_idProductoLocal')->unsigned();

            $table->foreign('ProductoLocal_idProductoLocal')->references('idProductoLocal')->on('ProductoLocal');

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
        Schema::dropIfExists('ProductoStock');
    }
}
