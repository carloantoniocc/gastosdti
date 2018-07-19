<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
            'password' => '$2y$10$1OLGihSv0gP8/bnUprLZfOHYIwLioX27wuW4hqqfzXmfu.JUiTLke', //admin123 en Bcrypt
            'active' => '1',
            'remember_token' => NULL,
            'created_at' => '2017-05-13 03:00:00',
            'updated_at' => '2017-05-13 03:00:00'
        ]);

    }
}
