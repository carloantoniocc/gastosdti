<?php

use Illuminate\Database\Seeder;

class TipoEstablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('tipo_estabs')->insert(['id' => '1','name' => 'CDT','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '2','name' => 'CECOSF','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '3','name' => 'CES','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '4','name' => 'CESFAM','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '5','name' => 'COSAM','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '6','name' => 'CRS','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '7','name' => 'Hospital','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '8','name' => 'Hospital de día','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '9','name' => 'PSR','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '10','name' => 'RBC','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '11','name' => 'SAPU','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '12','name' => 'SAR','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '13','name' => 'SUR','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '14','name' => 'UAPO','active' => '1','created_at' => NULL,'updated_at' => NULL ]); 

        DB::table('tipo_estabs')->insert(['id' => '15','name' => 'Consultorio General Urbano','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '16','name' => 'Dirección','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

        DB::table('tipo_estabs')->insert(['id' => '17','name' => 'Clinica Dental Movil','active' => '1','created_at' => NULL,'updated_at' => NULL ]);
        
        DB::table('tipo_estabs')->insert(['id' => '18','name' => 'Otro','active' => '1','created_at' => NULL,'updated_at' => NULL ]);

    }
}
