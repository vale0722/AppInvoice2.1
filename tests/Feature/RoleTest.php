<?php

namespace Tests\Feature;

use RolesSeeder;
use Tests\TestCase;
use PermissionSeeder;
use Illuminate\Support\Facades\Artisan;

class RoleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('config:clear');
        Artisan::call('migrate:fresh');
        $this->seed(PermissionSeeder::class);
        $this->seed(RolesSeeder::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
