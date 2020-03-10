<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin', 'description' => 'Administrador']);

        //assinging invoice permissions to the admin
        $role->givePermissionTo('view all invoices');
        $role->givePermissionTo('create invoice');
        $role->givePermissionTo('update invoice');
        $role->givePermissionTo('delete invoice');
        $role->givePermissionTo('show invoice');
        $role->givePermissionTo('import invoices');
        $role->givePermissionTo('export invoices');

        //assinging client permissions to the admin
        $role->givePermissionTo('view all clients');
        $role->givePermissionTo('create client');
        $role->givePermissionTo('update client');
        $role->givePermissionTo('delete client');
        $role->givePermissionTo('show client');
        $role->givePermissionTo('import clients');

        //asigning company permissions to the admin
        $role->givePermissionTo('view all companies');
        $role->givePermissionTo('create company');
        $role->givePermissionTo('update company');
        $role->givePermissionTo('delete company');

        //asignig product permissions to the admin
        $role->givePermissionTo('view all products');
        $role->givePermissionTo('create product');
        $role->givePermissionTo('update product');
        $role->givePermissionTo('delete product');

        //asignig user permissions to the admin
        $role->givePermissionTo('view all users');
        $role->givePermissionTo('create user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');

        $role = Role::create(['name' => 'company', 'description' => 'Vendedor']);

        //assinging invoice permissions to the company
        $role->givePermissionTo('view associated invoices');
        $role->givePermissionTo('create invoice');
        $role->givePermissionTo('update associated invoice');
        $role->givePermissionTo('delete associated invoice');
        $role->givePermissionTo('show associated invoice');
        $role->givePermissionTo('import invoices');

        //assinging client permissions to the company
        $role->givePermissionTo('view all clients');
        $role->givePermissionTo('create client');
        $role->givePermissionTo('update associated client');
        $role->givePermissionTo('delete associated client');
        $role->givePermissionTo('show associated client');
        $role->givePermissionTo('import clients');

        //asignig product permissions to the company
        $role->givePermissionTo('view all products');

        $role = Role::create(['name' => 'client', 'description' => 'Cliente']);

        //assinging invoice permissions to the client
        $role->givePermissionTo('view associated invoices');
        $role->givePermissionTo('pay invoice');
        $role->givePermissionTo('view payment attempts');
    }
}
