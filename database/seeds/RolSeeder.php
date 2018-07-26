<?php

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	DB::table('roles')->insert([
            'id' => '1',
            'rol' => 'Administrador',
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);

    }
}
