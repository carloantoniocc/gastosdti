<?php

use Illuminate\Database\Seeder;

class EstablecimientoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


		DB::table('establecimiento_user')->insert([
            'user_id' => '1',
            'establecimiento_id' => '1',            
        ]);  

    }
}
