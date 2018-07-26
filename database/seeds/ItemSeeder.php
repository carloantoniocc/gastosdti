<?php

use Illuminate\Database\Seeder;
use GastosDTI\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Item::create([
				'categorie_id' => 1,
				'name' => '(1) DATOS',
				'active' => 1,
				'storage_id' => 1,
    	]);

    	Item::create([
				'categorie_id' => 1,
				'name' => '(2) TELEFONIA',
				'active' => 1,
				'storage_id' => 1,
    	]);

    	Item::create([
				'categorie_id' => 1,
				'name' => '(3) SERVICIOS TRANSVERSALES',
				'active' => 1,
				'storage_id' => 1,
    	]);    	

        Item::create([
                'categorie_id' => 1,
                'name' => '(4) SERVICIOS ADICIONALES',
                'active' => 1,
                'storage_id' => 2,
        ]); 

    }
}
