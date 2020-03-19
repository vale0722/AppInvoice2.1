<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Type_Document;
use App\User;
use Faker\Generator as Faker;
use Faker\Provider\es_ES\Person;

$factory->define(Client::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    $id_type =  Type_Document::all()->random(1)->first();
    $id_card = $faker->ean8;
    $creator = User::whereHas(
        'Roles',
        function ($query) {
            $query->where('name', 'admin')->orWhere('name', 'company');
        }
    )->get()->random(1)->first();

    //client user creation
    $user = User::create([
        'name' => $faker->firstName,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->email,
        'email_verified_at' => now(),
        'password' => bcrypt($id_card),
        'remember_token' => '1',
    ]);
    $user->assignRole('client');
    return [
        'id_type' => $id_type->code,
        'id_card' => $id_card,
        'cellphone' => "12345678910",
        'country' => $faker->country,
        'department' => $faker->state,
        'city' => $faker->city,
        'address' => $faker->streetAddress,
        'creator_id' => $creator->id,
        'user_id' => $user->id,
    ];
});
