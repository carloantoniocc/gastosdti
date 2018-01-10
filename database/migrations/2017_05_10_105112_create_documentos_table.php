<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id')->index();
			$table->integer('proveedor_id')->unsigned();
			$table->integer('tipoDoc_id')->unsigned();
			$table->integer('establecimiento_id')->unsigned();
			$table->integer('nDoc');
			$table->integer('facAsociada')->nullable();
			$table->date('fechaEmision');
			$table->date('fechaRecepcion');
			$table->date('fechaVencimiento');
			$table->integer('monto');
			$table->string('ordenCompra')->nullable();
			$table->integer('nomina')->nullable();
			$table->string('archivo')->nullable();
			$table->integer('user_id')->unsigned();
            $table->timestamps();
			
			$table->unique(array('nDoc', 'proveedor_id', 'tipoDoc_id'));
			
			$table->foreign('proveedor_id')->references('id')->on('proveedors')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('tipoDoc_id')->references('id')->on('tipo_docs')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('establecimiento_id')->references('id')->on('establecimientos')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
