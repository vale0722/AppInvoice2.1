<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Invoice;
use Tests\Feature\RoleTest;

class ShowInvoiceTest extends RoleTest
{
    /**
     * @test
     */
    public function AuthenticatedAdminCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->creator->name);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->creator->name);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create(['client_id' => $client]);
        $response = $this->actingAs($client->user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->creator->name);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $invoice = factory(Invoice::class)->create();
        $response = $this->actingAs($treasurer)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->creator->name);
    }
}
