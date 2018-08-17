<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categorie_provider', function (Blueprint $table) {
            $table->integer('provider_id')->unsigned();
            $table->integer('categorie_id')->unsigned();

            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['categorie_id','provider_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_provider');
    }
}
