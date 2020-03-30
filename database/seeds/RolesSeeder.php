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
        $role->givePermissionTo('invoices.view');
        $role->givePermissionTo('invoices.create');
        $role->givePermissionTo('invoices.update');
        $role->givePermissionTo('invoices.delete');
        $role->givePermissionTo('invoices.show');
        $role->givePermissionTo('invoices.import');
        $role->givePermissionTo('invoices.export');
        $role->givePermissionTo('invoices.view.payment.attempts');

        //assinging client permissions to the admin
        $role->givePermissionTo('clients.view');
        $role->givePermissionTo('clients.create');
        $role->givePermissionTo('clients.update');
        $role->givePermissionTo('clients.deleted');
        $role->givePermissionTo('clients.show');
        $role->givePermissionTo('clients.import');
        $role->givePermissionTo('clients.export');

        //asignig product permissions to the admin
        $role->givePermissionTo('products.view');
        $role->givePermissionTo('products.create');
        $role->givePermissionTo('products.update');
        $role->givePermissionTo('products.delete');

        //asignig user permissions to the admin
        $role->givePermissionTo('users.view');
        $role->givePermissionTo('users.create');
        $role->givePermissionTo('users.show');
        $role->givePermissionTo('users.update');
        $role->givePermissionTo('users.delete');
        $role->givePermissionTo('users.your.show');

        $role = Role::create(['name' => 'company', 'description' => 'Vendedor']);

        //assinging invoice permissions to the company
        $role->givePermissionTo('invoices.view.associated');
        $role->givePermissionTo('invoices.create');
        $role->givePermissionTo('invoices.show');
        $role->givePermissionTo('invoices.update.associated');
        $role->givePermissionTo('invoices.import');
        $role->givePermissionTo('invoices.view.payment.attempts');

        //assinging client permissions to the company
        $role->givePermissionTo('clients.view');
        $role->givePermissionTo('clients.create');
        $role->givePermissionTo('clients.update.associated');
        $role->givePermissionTo('clients.delete.associated');
        $role->givePermissionTo('clients.show');
        $role->givePermissionTo('clients.import');
        $role->givePermissionTo('clients.export');

        //asignig product permissions to the company
        $role->givePermissionTo('products.view');

        //asignig user permissions to the company
        $role->givePermissionTo('users.update');
        $role->givePermissionTo('users.your.show');

        $role = Role::create(['name' => 'client', 'description' => 'Cliente']);

        //assinging invoice permissions to the client
        $role->givePermissionTo('invoices.view.associated');
        $role->givePermissionTo('invoices.show');
        $role->givePermissionTo('invoices.pay');
        $role->givePermissionTo('invoices.view.payment.attempts');

        //asignig user permissions to the client
        $role->givePermissionTo('clients.update.associated');
        $role->givePermissionTo('users.your.show');
    }
}
