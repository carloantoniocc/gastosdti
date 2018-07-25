<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('filename');
            $table->string('filenamestorage');
            $table->integer('iduser');
            $table->timestamps();

            $table->integer('storage_id')->unsigned(); 
            $table->foreign('storage_id')->references('id')->on('storages')->onUpdate('cascade')->onDelete('cascade');            



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
