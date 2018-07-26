<?php

use Illuminate\Database\Seeder;

class DolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('dolars')->insert([
            'fecha' => '2018-04-01 03:00:00',
            'valor' => '650',   
            'active' => '1',         
        ]); 


    }
}
