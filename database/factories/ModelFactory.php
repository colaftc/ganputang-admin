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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
		'brand' => $faker->name,
		'contact' => $faker->name,
		'mobile' => $faker->e164PhoneNumber,
    ];
});

$factory->define(App\ProductType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'remarks' => $faker->address,
    ];
});


$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'spec' => $faker->address,
		'in_price' => 800,
		'out_price' => 1600,
		'out_wholesaleprice' => 800,
		'type_id' => 1,
		'remarks'=>str_random(10)
    ];
});
