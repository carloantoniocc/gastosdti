<?php

use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
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

    }
}
