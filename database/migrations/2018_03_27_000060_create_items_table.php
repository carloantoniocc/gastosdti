<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categorie_id')->unsigned();
            $table->string('name');
            $table->boolean('active');
            $table->integer('storage_id')->unsigned(); 
            $table->timestamps();
            
            $table->foreign('storage_id')->references('id')->on('storages')->onUpdate('cascade')->onDelete('cascade');             
            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
