<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code' => $faker->numerify('P###'),
        'price' => $faker->numberBetween($min = 100, $max = 1000000),
        'name' =>$faker->jobTitle 
    ];
});
