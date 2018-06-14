<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\medico::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastName'=>$faker->lastname,
        'gender'=>'masculino',
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('1234'), // secret
    ];
});

// // $factory->define(App\event::class, function (Faker $faker) {
// //     return [
// //         'title' => $faker->sentence(4),
// //         'start' => $faker->dateTimeInInterval(),
// //         'end' => $faker->dateTimeInInterval(),
// //         'color' => $faker->hexcolor(),
// //
// //     ];
// // });
// //
// // $factory->define(App\event::class, function (Faker $faker) {
// //     return [
// //         'title' => $faker->sentence(4),
// //         'start' => $faker->dateTimeInInterval(),
// //         'end' => $faker->dateTimeInInterval(),
// //         'color' => $faker->hexcolor(),
// //
// //     ];
// });
