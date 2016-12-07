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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nombre');
            $table->String('descripcion');
            $table->double('precio',15,4);
            $table->double('iva',15,4)->nullable();
            $table->double('ieps',15,4)->nullable();
            $table->double('descuento_maximo',15,4);
            $table->String('categoria');
            $table->String('unidades');
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
        Schema::drop('productos');
    }
}
