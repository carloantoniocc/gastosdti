<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('provider_id')->unsigned();
            $table->integer('categorie_id')->nullable()->unsigned();            
            $table->integer('numero');
            $table->date('fecha_recepcion');
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('monto', 8, 2)->nullable();
            $table->decimal('montoresumen', 8, 2)->nullable();
            $table->integer('notacredito')->nullable();
            $table->integer('orden_compra')->nullable();
            $table->boolean('active')->default(true);   
            $table->softDeletes();         
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void+6
     */
    public function down()
    {

        Schema::table('facturas', function (Blueprint $table) 
        {


        });


        Schema::dropIfExists('facturas');

    }
}
