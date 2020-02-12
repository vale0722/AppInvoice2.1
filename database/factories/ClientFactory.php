<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Type_Document;
use Faker\Generator as Faker;
use Faker\Provider\es_ES\Person;

$factory->define(Client::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    $id_type =  Type_Document::all()->random(1)->first();
    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastname,
        'id_type' => $id_type->code,
        'id_card' => $faker->ean8,
        'email' => $faker->unique()->email,
        'cellphone' => "12345678910",
        'country' => $faker->country,
        'department' => $faker->state,
        'city' => $faker->city,
        'address' => $faker->streetAddress

    ];
});
