<?php

use App\User;
use App\Client;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin user creation
        $user = User::create([
            'name' => 'Admin',
            'lastname' => 'Administrador',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => '1',
        ]);
        $user->assignRole('admin');

        //treasurer user creation
        $user = User::create([
            'name' => 'Treasurer',
            'lastname' => 'Tesorero',
            'email' => 'tesorero@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => '1',
        ]);
        $user->assignRole('treasurer');

        //client user creation
        $user = User::create([
            'name' => 'Client',
            'lastname' => 'Client',
            'email' => 'client@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => '1',
        ]);
        $user->assignRole('client');
        Client::create([
            'id_type' => 'CC',
            'id_card' => '123456789',
            'cellphone' => "12345678910",
            'country' => 'Colombia',
            'department' => 'Antioquia',
            'city' => 'Medellin',
            'address' => 'cll 12 - 1',
            'creator_id' => '1',
            'user_id' => $user->id,
        ]);

        //company user creation
        $user = User::create([
            'name' => 'company',
            'lastname' => 'company',
            'email' => 'company@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => '1',
        ]);
        $user->assignRole('company');

        $user = factory(User::class)->create();
        $user->assignRole('company');
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $user = factory(User::class)->create();
        $user->assignRole('company');
    }
}
