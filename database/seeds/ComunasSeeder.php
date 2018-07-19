<?php

use Illuminate\Database\Seeder;

class ComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


		DB::table('comunas')->insert(['id' => '1', 'codigo' => '13101', 'name' => 'Santiago', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '2', 'codigo' => '13126', 'name' => 'Quinta Normal', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);        
        DB::table('comunas')->insert(['id' => '3', 'codigo' => '13124', 'name' => 'Pudahuel', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '4', 'codigo' => '13117', 'name' => 'Lo Prado', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '5', 'codigo' => '13103', 'name' => 'Cerro Navia', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '6', 'codigo' => '13128', 'name' => 'Renca', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '7', 'codigo' => '13503', 'name' => 'Curacavi', 'rural' => '2', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '8', 'codigo' => '13504', 'name' => 'Maria Pinto', 'rural' => '2', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);               
        DB::table('comunas')->insert(['id' => '9', 'codigo' => '13604', 'name' => 'Padre Hurtado', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '10', 'codigo' => '13605', 'name' => 'Peñaflor', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '11', 'codigo' => '13602', 'name' => 'El Monte', 'rural' => '2', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '12', 'codigo' => '13601', 'name' => 'Talagante', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '13', 'codigo' => '13603', 'name' => 'Isla de Maipo', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '14', 'codigo' => '13501', 'name' => 'Melipilla', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);

        DB::table('comunas')->insert(['id' => '15', 'codigo' => '13505', 'name' => 'San Pedro', 'rural' => '2', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);
        
        DB::table('comunas')->insert(['id' => '16', 'codigo' => '13502', 'name' => 'Alhue', 'rural' => '2', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);                
        DB::table('comunas')->insert(['id' => '17', 'codigo' => '13123', 'name' => 'Providencia', 'rural' => '1', 'active' => '1', 'created_at' => NULL,'updated_at' => NULL]);


    }
}
