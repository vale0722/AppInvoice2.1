<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Faker\Provider\es_ES\Person;

$factory->define(Client::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
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