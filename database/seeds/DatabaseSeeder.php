<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $this->call(UsersTableSeeder::class);
    	//ROLES    	
    	DB::table('roles')->insert([
            'id' => '1',
            'rol' => 'Administrador',
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);

    	//COMUNAS
		DB::table('comunas')->insert([
	        'id' => '1',
	        'name' => 'Santiago',
	        'active' => '1',
	        'created_at' => '2017-05-13 03:00:00',
	        'updated_at' => '2017-05-13 03:00:00'
        ]);
    	
    	//TIPOS DE ESTABLECIMIENTOS
		DB::table('tipo_estabs')->insert([
            'id' => '1',
            'name' => 'Hospital',
            'active' => '1',
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);
    	
    	//ESTABLECIMIENTOS

		DB::table('establecimientos')->insert([
            'id' => '1',
            'code' => '100',
            'name' => 'Direccion SSMOC',
            'tipo_id' => '1',
            'comuna_id' => '1',
            'direccion' => 'Sin Asignar',
            'X' => '0',
            'Y' => '0',
            'active' => '1',
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);
    	
    	//USUARIO

		DB::table('users')->insert([
            'id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@admin.cl',
            'password' => '$2y$10$1OLGihSv0gP8/bnUprLZfOHYIwLioX27wuW4hqqfzXmfu.JUiTLke', //admin123 en Bcrypt
            'active' => '1',
            'remember_token' => NULL,
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);

        //ROL DE USUARIO

		DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',            
        ]);

        //ESTABLECIMIENTO DE USUARIO

		DB::table('establecimiento_user')->insert([
            'user_id' => '1',
            'establecimiento_id' => '1',            
        ]);  	 	
        
        
    }
}
