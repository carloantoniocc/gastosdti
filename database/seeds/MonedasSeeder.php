<?php

use Illuminate\Database\Seeder;

class MonedasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('monedas')->insert(['name' => 'Peso','active' => '1',]);
        DB::table('monedas')->insert(['name' => 'UF','active' => '1',]);

    }
}
