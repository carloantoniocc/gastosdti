<?php

use Illuminate\Database\Seeder;
USE GastosDTI\Provider;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   

        DB::table('providers')->insert([
            'name' => 'Entel',
            'rut' => '123123123',   
            'active' => '1',         
        ]);

        DB::table('providers')->insert([
            'name' => 'Saydex',
            'rut' => '123123123',   
            'active' => '1',         
        ]);


        DB::table('providers')->insert([
            'name' => 'Intersystems',
            'rut' => '121212121',   
            'active' => '1',         
        ]);        


        //factory(Provider::class,20)->create();


    }
}
