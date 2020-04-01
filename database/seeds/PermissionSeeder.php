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
        $permission = Permission::create(['name' => 'invoices.view']);
        $permission = Permission::create(['name' => 'invoices.view.associated']);
        $permission = Permission::create(['name' => 'invoices.create']);
        $permission = Permission::create(['name' => 'invoices.update']);
        $permission = Permission::create(['name' => 'invoices.update.associated']);
        $permission = Permission::create(['name' => 'invoices.delete']);
        $permission = Permission::create(['name' => 'invoices.show']);
        $permission = Permission::create(['name' => 'invoices.import']);
        $permission = Permission::create(['name' => 'invoices.export']);
        $permission = Permission::create(['name' => 'invoices.pay']);
        $permission = Permission::create(['name' => 'invoices.anuled']);
        $permission = Permission::create(['name' => 'invoices.view.payment.attempts']);

        // client permissions
        $permission = Permission::create(['name' => 'clients.view']);
        $permission = Permission::create(['name' => 'clients.create']);
        $permission = Permission::create(['name' => 'clients.update']);
        $permission = Permission::create(['name' => 'clients.update.associated']);
        $permission = Permission::create(['name' => 'clients.deleted']);
        $permission = Permission::create(['name' => 'clients.delete.associated']);
        $permission = Permission::create(['name' => 'clients.show']);
        $permission = Permission::create(['name' => 'clients.import']);
        $permission = Permission::create(['name' => 'clients.export']);

        // product permissions
        $permission = Permission::create(['name' => 'products.view']);
        $permission = Permission::create(['name' => 'products.create']);
        $permission = Permission::create(['name' => 'products.update']);
        $permission = Permission::create(['name' => 'products.delete']);

        //user permissions
        $permission = Permission::create(['name' => 'users.view']);
        $permission = Permission::create(['name' => 'users.create']);
        $permission = Permission::create(['name' => 'users.show']);
        $permission = Permission::create(['name' => 'users.update']);
        $permission = Permission::create(['name' => 'users.delete']);
        $permission = Permission::create(['name' => 'users.your.show']);
    }
}
