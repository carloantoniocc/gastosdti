<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resumen')->nullable();            
            $table->integer('resumen2')->nullable();
            $table->integer('item_id')->unsigned();
            $table->integer('factura_id')->unsigned();
            $table->decimal('monto', 8, 2)->nullable();  
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('factura_id')->references('id')->on('facturas')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumen_facturas');
    }
}
