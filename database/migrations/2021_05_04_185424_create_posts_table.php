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
            $table->string('slug'); //Para una url amigable.
            $table->text('extract')->nullable();
            $table->longText('body')->nullable();
            $table->enum('status', [1,2])->default(1); //Estado 1 borrador, estado 2 publicado. Por defecto el estado es 1.

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //Referenciamos al id de la tabla usuarios. Si el usuario se elimina, se eliminan todos sus posts.
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //Si eliminamos una categoria, todos los posts relacionados se eliminan.
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
        Schema::dropIfExists('posts');
    }
}
