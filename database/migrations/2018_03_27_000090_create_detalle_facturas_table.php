<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comuna_id')->nullable()->unsigned();
            $table->integer('establecimiento_id')->nullable()->unsigned();
            $table->integer('resumen_id')->unsigned();            
            $table->boolean('active')->default(true);            

            //Servicios del contrato
            $table->integer('cantidad')->nullable();
            $table->integer('valorunitario')->nullable();


            //Servicios adicionales
            $table->string('servicio')->nullable();
            $table->decimal('pagounico', 8, 2)->nullable(); 
            $table->decimal('rentamensual', 8, 2)->nullable(); 
            $table->string('plazo')->nullable();
            $table->string('iniciocobro')->nullable();
            $table->string('cuota')->nullable();

            //totalizadores
            $table->integer('total');  
            $table->timestamps();


            $table->foreign('resumen_id')->references('id')->on('resumen_facturas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comuna_id')->references('id')->on('comunas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('establecimiento_id')->references('id')->on('establecimientos')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
}
