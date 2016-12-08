<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->String('notas')->nullable();
            $table->integer('total_productos');
            $table->double('descuento_porcentaje',15,4);
            $table->double('descuento_pesos',15,4);
            $table->double('subtotal',15,4);
            $table->double('iva',15,4);
            $table->double('ieps',15,4);
            $table->double('total',15,4);
            $table->boolean('activo');
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
        Schema::drop('ventas', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
        });
    }
}
