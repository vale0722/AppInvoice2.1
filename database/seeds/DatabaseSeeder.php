<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TypeDocumentSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
