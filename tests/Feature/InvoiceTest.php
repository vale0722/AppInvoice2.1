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

    /**
     * @test
     */
    public function AuthenticatedUserCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->company->name);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $client = factory(Client::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id,
            'company' => $company->id,
            'stateReceipt' => '2'
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
    public function AuthenticatedUserCanDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->delete(route('invoices.destroy', $invoice))
            ->assertRedirect(route('invoices.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('invoices', [
            'title' => $invoice->title,
            'code' => $invoice->code,
        ]);
    }
}
