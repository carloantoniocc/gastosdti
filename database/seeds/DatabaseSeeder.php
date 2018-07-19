<?php

use Illuminate\Database\Seeder;
use GastosDTI\Dolar;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $this->truncateTables([
            'roles',
            'comunas',
            'tipo_estabs',
            'establecimientos',
            'users',
            'role_user',
            'establecimiento_user',
            'dolars',
            'Ufs',
            'providers',
            'monedas',
            'categories',
            'storages',
        ]);        

        $this->call(RolesSeeder::class);
        $this->call(ComunasSeeder::class);
        $this->call(TipoEstablecimientoSeeder::class);
        $this->call(EstablecimientosSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(EstablecimientoUserSeeder::class);
        $this->call(DolarsSeeder::class);
        $this->call(UfsSeeder::class);
        $this->call(ProvidersSeeder::class);
        $this->call(MonedasSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(StoragesSeeder::class);


    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
 
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }




}
