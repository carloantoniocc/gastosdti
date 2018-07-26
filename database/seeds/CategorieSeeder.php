<?php

use Illuminate\Database\Seeder;
use GastosDTI\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// para ejecutar seeder en particular
    	// php artisan db:seed --class=CategorieSeeder

        DB::table('categories')->insert([
            'name' => 'Entel Servicios',
            'active' => '1',  
            'descripcion' => 'Resumen mensual fijo'       
        ]);

        // importando la clase -- use GastosDTI\Categorie;
        Categorie::create([

            'name' => 'Entel Hogar',
            'active' => '1',  
            'descripcion' => 'Resumen mensual fijo'       

        ]);

        DB::table('categories')->insert([
            'name' => 'Saydex',
            'active' => '1',  
            'descripcion' => 'Resumen de lun'       
        ]);

        // importando la clase -- use GastosDTI\Categorie;
        Categorie::create([

            'name' => 'Intersystems',
            'active' => '1',  
            'descripcion' => 'Resumen lun'       

        ]);        

        //en caso de error  Unable to locate factory with name [default] [GastosDTI\Categorie].
        // se debe crear el factory
        //factory(Categorie::class, 20)->create();

    }
}
