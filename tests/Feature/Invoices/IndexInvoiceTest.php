<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Company;
use App\Invoice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexInvoiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessTheIndexView()
    {
        // Unauthenticated user
        $response = $this->get(route('invoices.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessInvoiceList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('invoices.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanSeeTheInvoiceList()
    {
        $this->seed("TypeDocumentSeeder");
        factory(Client::class, 5)->create();
        factory(Company::class, 5)->create();
        factory(Invoice::class, 5)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('invoices.index'));

        $response->assertViewHas('invoices');
    }
}
