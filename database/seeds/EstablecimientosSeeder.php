<?php

use Illuminate\Database\Seeder;

class EstablecimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('establecimientos')->insert([
            'id' => '1',
            'code' => '110010',
            'entelcode' => NULL,
            'name' => 'S.S Metropolitano Occidente',
            'tipo_id' => '1',
            'comuna_id' => '1',
            'direccion' => '',
            'X' => '0',
            'Y' => '0',
            'active' => '1',
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);



    }
}
