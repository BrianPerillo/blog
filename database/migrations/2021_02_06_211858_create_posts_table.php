<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('body');
            $table->unsignedBigInteger('user_id')->nullable(); //nullable x el set null de abajo
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');//set null para que si se elimina el user
            $table->unsignedBigInteger('category_id')->nullable();    //su post siga existiendo y no se elimine este registro, la foreign
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');//quedará nula y el resto del registro
            $table->timestamps(); //intacto. Con el cascade eliminabamos x completo los 2 registros. Lo mismo para la foreign de 
        });                       //Categories
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
