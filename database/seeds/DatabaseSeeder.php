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
            'facturas',
            'items',
        ]);        


        $this->call(CategorieSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstablecimientoSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(RolUserSeeder::class);
        $this->call(TipoEstabSeeder::class);
        $this->call(ComunaSeeder::class);
        $this->call(EstablecimientoUserSeeder::class);
        $this->call(ProviderSeeder::class); 
        $this->call(UfSeeder::class);       
        $this->call(DolarSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(StorageSeeder::class);
        $this->call(FacturaSeeder::class);
        $this->call(ItemSeeder::class);


    }

    public function truncateTables(array $tables)
    {
        // desactivar restriccion clave foranea
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        //eliminar las tablas
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
 
        // Activar restriccion clave foranea
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }




}
