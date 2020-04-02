<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Invoice;

class UpdateInvoiceTest extends InvoiceTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanEditViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.edit', $invoice));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCanEditViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.edit', $invoice))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotEditViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $admin = factory(User::class)->create();
        $admin->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.edit', $invoice))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotEditViewInvoice()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($client->user)->get(route('invoices.edit', $invoice))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'state' => "Por Defecto",
            "client" => $client->id,
            'stateReceipt' => '2',
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
    public function AuthenticatedCompanyUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'state' => "Por Defecto",
            "client" => $client->id,
            'stateReceipt' => '2',
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
    public function AuthenticatedClientCannotUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($client->user)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'state' => "Por Defecto",
            "client" => $client->id,
            'stateReceipt' => '2',
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
    public function AuthenticatedTreasurerCannotUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($treasurer)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'state' => "Por Defecto",
            "client" => $client->id,
            'stateReceipt' => '2',
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'creator_id' => $user->id,
        ]);
    }
}
