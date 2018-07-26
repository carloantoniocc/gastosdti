<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name');
            $table->string('descripcion');
            $table->boolean('active')->default(true);

            $table->integer('moneda_id')->nullable()->unsigned();
            $table->timestamps();            

            $table->foreign('moneda_id')->references('id')->on('monedas')->onUpdate('cascade')->onDelete('cascade');             

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('categories');


    }
}
