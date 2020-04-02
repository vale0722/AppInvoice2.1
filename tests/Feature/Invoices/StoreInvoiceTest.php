<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Invoice;
use App\Product;
use Tests\Feature\RoleTest;

class StoreInvoiceTest extends RoleTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanCreateViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user)->get(route('invoices.create'));
        $this->assertAuthenticatedAs($user);
    }
    /**
     * @test
     */
    public function anAuthenticatedCompanyCanCreateViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('invoices.create'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotCreateViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $this->actingAs($user)->get(route('invoices.create'))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotCreateViewInvoice()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->get(route('invoices.create'))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotStoreAInvoice()
    {
        $response = $this->post(route('invoices.store'), []);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotCreateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($treasurer)->post(route('invoices.store'), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanCreateAnInvoiceProduct()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->post(route('invoices.product.store', $invoice->id), [
            'invoice' => $invoice->id,
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

    /**
     * @test
     */
    public function AuthenticatedCompanyCanCreateAnInvoiceProduct()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->post(route('invoices.product.store', $invoice->id), [
            'invoice' => $invoice->id,
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

    /**
     * @test
     */
    public function AuthenticatedClientCannotCreateAnInvoiceProduct()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($client->user)->post(route('invoices.product.store', $invoice->id), [
            'invoice' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2',
            'unit_value' => $product->price,
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('invoice_product', [
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2'
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotCreateAnInvoiceProduct()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $invoice = factory(Invoice::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($treasurer)->post(route('invoices.product.store', $invoice->id), [
            'invoice' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2',
            'unit_value' => $product->price,
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('invoice_product', [
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => '2'
        ]);
    }
}
