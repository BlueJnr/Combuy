<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Producto', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->string('Nom_producto');
            $table->integer('TipoProd_idTipoProd')->unsigned();
            $table->integer('Marca_idProducto_caract')->unsigned();
            $table->integer('Caracteristica_idCarProd')->unsigned();

            $table->foreign('TipoProd_idTipoProd')->references('idTipoProd')->on('TipoProd');
            $table->foreign('Marca_idProducto_Caract')->references('idProducto_Caract')->on('Marca');
            $table->foreign('Caracteristica_idCarProd')->references('idCarProd')->on('Caracteristicas');
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
        Schema::dropIfExists('Producto');
    }
}
