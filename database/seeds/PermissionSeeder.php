<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // invoice permissions
        $permission = Permission::create(['name' => 'view all invoices']);
        $permission = Permission::create(['name' => 'view associated invoices']);
        $permission = Permission::create(['name' => 'create invoice']);
        $permission = Permission::create(['name' => 'update invoice']);
        $permission = Permission::create(['name' => 'update associated invoice']);
        $permission = Permission::create(['name' => 'delete invoice']);
        $permission = Permission::create(['name' => 'show invoice']);
        $permission = Permission::create(['name' => 'import invoices']);
        $permission = Permission::create(['name' => 'export invoices']);
        $permission = Permission::create(['name' => 'pay invoice']);
        $permission = Permission::create(['name' => 'view payment attempts']);

        // client permissions
        $permission = Permission::create(['name' => 'view all clients']);
        $permission = Permission::create(['name' => 'create client']);
        $permission = Permission::create(['name' => 'update client']);
        $permission = Permission::create(['name' => 'update associated client']);
        $permission = Permission::create(['name' => 'delete client']);
        $permission = Permission::create(['name' => 'delete associated client']);
        $permission = Permission::create(['name' => 'show client']);
        $permission = Permission::create(['name' => 'import clients']);
        $permission = Permission::create(['name' => 'export clients']);

        // product permissions
        $permission = Permission::create(['name' => 'view all products']);
        $permission = Permission::create(['name' => 'create product']);
        $permission = Permission::create(['name' => 'update product']);
        $permission = Permission::create(['name' => 'delete product']);

        //user permissions
        $permission = Permission::create(['name' => 'view all users']);
        $permission = Permission::create(['name' => 'create user']);
        $permission = Permission::create(['name' => 'show user']);
        $permission = Permission::create(['name' => 'update user']);
        $permission = Permission::create(['name' => 'delete user']);
        $permission = Permission::create(['name' => 'show your user']);
    }
}
