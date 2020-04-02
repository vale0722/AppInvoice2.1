<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Invoice;

class IndexInvoiceTest extends InvoiceTest
{

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
    public function AuthenticatedAdminHasAccessInvoiceList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user)->get(route('invoices.index'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyHasAccessInvoiceList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('invoices.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerHasAccessInvoiceList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $this->actingAs($user)->get(route('invoices.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedClientHasAccessInvoiceList()
    {
        // Authenticated user 
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->get(route('invoices.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanSeeTheInvoiceList()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        factory(Client::class, 5)->create();
        factory(Invoice::class, 5)->create();
        $response = $this->actingAs($user)->get(route('invoices.index'));
        $response->assertViewHas('invoices');
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCanSeeTheInvoiceList()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        factory(Client::class, 5)->create();
        factory(Invoice::class, 5)->create();
        $response = $this->actingAs($user)->get(route('invoices.index'));
        $response->assertViewHas('invoices');
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanSeeTheInvoiceList()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('company');
        factory(Client::class, 5)->create();
        factory(Invoice::class, 5)->create();
        $response = $this->actingAs($user)->get(route('invoices.index'));
        $response->assertViewHas('invoices');
    }

    /**
     * @test
     */
    public function AuthenticatedClientCanSeeTheInvoiceList()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        Invoice::create([
            'title' => 'TestTitle',
            'code' => 'TestCode',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
        $response = $this->actingAs($client->user)->get(route('invoices.index'));
        $response->assertViewHas('invoices');
    }
}
