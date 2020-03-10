<?php

use App\User;
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
    }
}
