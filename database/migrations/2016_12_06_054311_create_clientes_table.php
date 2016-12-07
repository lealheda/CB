<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc');
            $table->string('nombre_comercial');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('calle');
            $table->string('numero');
            $table->string('colonia');
            $table->integer('codigo_postal');
            $table->string('municipio');
            $table->string('estado');
            $table->string('pais');
            $table->boolean('activo');
            $table->rememberToken();
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
         Schema::drop('clientes');
    }
}
