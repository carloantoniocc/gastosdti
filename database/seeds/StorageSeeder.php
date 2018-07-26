<?php

use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('storages')->insert(['name' => 'Servicios del Contrato', 'active' => '1', 'codigo' => 'STG01', 'downloadname' => 'ServiciosDelContrato.xlsx', 'catalogoname' => 'ServiciosDelContrato.docx' ]);
        DB::table('storages')->insert(['name' => 'Servicios Adicionales', 'active' => '1', 'codigo' => 'STG02', 'downloadname' => 'ServiciosAdicionales.xls', 'catalogoname' => 'ServiciosAdicionales.docx' ]);


    }
}
