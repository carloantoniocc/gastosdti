<?php

use Illuminate\Database\Seeder;
use GastosDTI\Factura;
use GastosDTI\Provider;
use GastosDTI\Categorie;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//		factory(Factura::class, 100)->create();


 /**       
    	$provider = Provider::all();
    	$id_providers = $provider->pluck('id');


    	$categorie = Categorie::all();
    	$id_categories = $categorie->pluck('id');


    	factory(Factura::class, 500)->create([
    		'provider_id' => rand($id_providers->first(), $id_providers->last()),
    		'categorie_id' => rand($id_categories->first(), $id_categories->last()),

    	]);
**/

    }
}
