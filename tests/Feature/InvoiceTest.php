<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use App\Company;
use App\Invoice;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessTheHomeView()
    {
        $response = $this->get(route('home'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessTheHomeView()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('home'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessInvoiceList()
    {
        // Unauthenticated user
        $response = $this->get(route('invoices.index'));
        $response->assertRedirect(route('login'));
        // Authenticated user
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('invoices.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'company_id' => $company->id,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'company_id' => $company->id,
        ]);
    }

     /**
     * @test
     */
    public function AuthenticatedUserCanCreateAnInvoiceProduct()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->post(route('invoices.product.store', $invoice->id), [
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2',
            'unit_value' => $product->price,
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('invoice_product', [
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2'
        ]);
    }
}
