<?php

namespace Tests\Feature\Invoices;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateInvoiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotAccessToTheCreationRoute()
    {
        $response = $this->get("/invoices/create");
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessToTheCreationRoute()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get("/invoices/create");
        $response->assertOk();
    }

    /**
     * @test
     */
    public function correctViewIsDisplayed()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get("/invoices/create");

        $response->assertViewIs('invoice.create');
    }
}
