<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdnegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodnegocios', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('idlocalnegocio')->unsigned();
            $table->integer('idproductolocal')->unsigned();

            $table->decimal('precio',3,2);
            $table->integer('stock');
            
            $table->foreign('idlocalnegocio')->references('id')->on('localnegocio');
            $table->foreign('idproductolocal')->references('id')->on('productolocal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodnegocios');
    }
}
