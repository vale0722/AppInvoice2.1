<?php

namespace Tests\Feature\Invoices;

use RolesSeeder;
use Tests\TestCase;
use PermissionSeeder;
use Illuminate\Support\Facades\Artisan;

class InvoiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('config:clear');
        Artisan::call('migrate:fresh');
        $this->seed(PermissionSeeder::class);
        $this->seed(RolesSeeder::class);
    }
}
