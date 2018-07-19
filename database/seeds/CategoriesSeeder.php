<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            'name' => 'Entel Servicios',
            'active' => '1',  
            'moneda_id' => '1',  
            'descripcion' => 'Resumen mensual fijo'       
        ]);

    }
}
