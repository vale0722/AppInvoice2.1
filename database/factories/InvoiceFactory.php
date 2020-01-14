<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Company;
use App\Invoice;
use Faker\Generator as Faker;



$factory->define(Invoice::class, function (Faker $faker) {
    
    $client = factory(Client::class)->create();
    $company = factory(Company::class)->create();
    return [
        'title' => $faker->name,
        'code' => $faker->bothify('?###') ,
        'client_id' => $client->id,
        'company_id' => $company->id,
    ];
});
