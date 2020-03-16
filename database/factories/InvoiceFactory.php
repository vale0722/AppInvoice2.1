<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Client;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    $client = factory(Client::class)->create();
    $creator = User::whereHas(
        'Roles',
        function ($query) {
            $query->where('name',  'admin')->orWhere('name', 'company');
        }
    )->first();
    return [
        'title' => $faker->name,
        'code' => $faker->bothify('?###'),
        'client_id' => $client->id,
        'creator_id' => $creator->id,
        'state' => 'DEFAULT'
    ];
});
