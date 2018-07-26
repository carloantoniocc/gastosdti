<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// https://github.com/fzaninotto/Faker

$factory->define(GastosDTI\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name('female'),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(GastosDTI\Categorie::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'active' => 1,
        'descripcion' => $faker->sentence(3),
    ];
});

$factory->define(GastosDTI\Establecimiento::class, function (Faker\Generator $faker) {

    return [
        'code' => $faker->ean8,
        'entelcode' => $faker->ean8,
        'name' => $faker->company,
//        'tipo_id' => $faker->randomDigit,
//        'comuna_id' => $faker->randomDigit,
        'direccion' => $faker->address,
        'X' => $faker->latitude(-90,90),
        'Y' => $faker->longitude(-180,180),
        'active' => 1,


    ];
});

$factory->define(GastosDTI\Provider::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'rut' => $faker->isbn10,
        'active' => 1,


    ];
});

$factory->define(GastosDTI\Uf::class, function (Faker\Generator $faker) {

    return [
        'fecha' => $faker->dateTime('now'),
        'valor' => $faker->randomDigit,
        'active' => 1,

    ];
});


$factory->define(GastosDTI\Factura::class, function (Faker\Generator $faker) {

    return [
        'provider_id' => rand(1,3),
        'categorie_id' => rand(1,4),
        'numero' => $faker->numberBetween(5000,800000),
        'fecha_recepcion' => $faker->dateTime('now'),
        'fecha_emision' => $faker->dateTime('now'),
        'fecha_vencimiento' => $faker->dateTime('now'),
        'monto' => $faker->randomFloat(2,1,10000),
        'montoresumen' => $faker->randomFloat(2,1,10000),
        'notacredito' => $faker->numberBetween(5000,800000),
        'orden_compra' => $faker->numberBetween(5000,800000),        
        'active' => 1,  


    ];
});
