<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'last_name'=> $faker->lastname,
        'id_type'=> $faker->randomLetter,
        'id_card'=> $faker->ean8,
        'email'=> $faker->unique()->email,
        'cellphone'=> $faker->ean8,
        'country'=> $faker->country, 
        'city'=> $faker->city,
        'address'=> $faker->streetAddress

    ];
});
?>