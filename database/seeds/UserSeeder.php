<?php

use Illuminate\Database\Seeder;
use GastosDTI\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

		DB::table('users')->insert([
            'id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@admin.cl',
            'password' => bcrypt('admin1234'), //
            //'password' => '$2y$10$1OLGihSv0gP8/bnUprLZfOHYIwLioX27wuW4hqqfzXmfu.JUiTLke', //admin123 en Bcrypt
            'active' => '1',
            'remember_token' => NULL,
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);       

    	factory(User::class, 50)->create();

    }
}
