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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'location' => $faker->countryCode,
        'instrument' => str_random(2),
        'genre' => str_random(3),

    ];
});

$factory->define(App\Band::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'time' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'place' => $faker->countryCode,
        'description' => $faker->text,
    ];
});

$factory->define(App\Bandmember::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'band_id' => factory(App\Band::class)->create()->id,
    ];
});

$factory->define(App\Friend::class, function (Faker\Generator $faker) {
    return [
        'user_id_action' => factory(App\User::class)->create()->id,
        'user_id_response' => factory(App\User::class)->create()->id,
        'status' => rand(0,2),
        'description' => $faker->text,
    ];
});

$factory->define(App\Reqjoin::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'band_id' => factory(App\Band::class)->create()->id,
        'status' => rand(0,2),
        'description' => $faker->text,
    ];
});
