<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Company;
use App\Invoice;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreInvoiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotStoreAProduct()
    {
        $response = $this->post(route('invoices.store'), []);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id,
            'company' => $company->id,
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
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->post(route('invoices.product.store', $invoice->id), [
            'invoice' => $invoice->id,
            'product' => $product->id,
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
