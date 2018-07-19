<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->integer('moneda_id')->unsigned();
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
        Schema::table('categories', function (Blueprint $table) {
            

            $table->unsignedInteger('moneda_id');
            $table->dropColumn('moneda_id');
            $table->dropForeign('moneda_id');

            
        });
    }
}
