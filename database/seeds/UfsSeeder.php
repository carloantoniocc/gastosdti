<?php

use Illuminate\Database\Seeder;

class UfsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ufs')->insert([
            'fecha' => '2018-04-01 03:00:00',
            'valor' => '26800',   
            'active' => '1',         
        ]);


    }
}
