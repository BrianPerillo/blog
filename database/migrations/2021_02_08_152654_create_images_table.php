<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            //Ya que es una tabla con clave primaria compuesta no creo un $table->id();!!
            $table->string('url');
            $table->unsignedBigInteger('imageable_id');//Recibe un int por lo tanto es unsignedBigInteger
            $table->string('imageable_type');//Recibe el type por lo que es un string
            $table->primary(['imageable_id', 'imageable_type']); // Indico que las 2 anteriores serán claves primarias - Clave primaria compuesta.
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
        Schema::dropIfExists('images');
    }
}
