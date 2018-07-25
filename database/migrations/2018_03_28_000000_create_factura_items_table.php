<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->decimal('monto', 8, 2)->nullable();             
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('factura_id')->references('id')->on('facturas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('factura_items', function (Blueprint $table) 
        {
            

            $table->dropForeign('factura_items_factura_id_foreign');
            $table->dropForeign('factura_items_item_id_foreign');
            $table->dropColumn('factura_id');
            $table->dropColumn('item_id');

           
        });

        Schema::dropIfExists('factura_items');

    }
}
