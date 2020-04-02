<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use App\Invoice;
use Tests\Feature\Invoices\InvoiceTest;

class DeleteInvoiceTest extends InvoiceTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanConfirmDeleteViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.confirm.delete', $invoice));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCanConfirmDeleteViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.confirm.delete', $invoice))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotConfirmDeleteViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $admin = factory(User::class)->create();
        $admin->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->get(route('invoices.confirm.delete', $invoice))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotConfirmDeleteViewInvoice()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($client->user)->get(route('invoices.confirm.delete', $invoice))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
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

    /**
     * @test
     */
    public function AuthenticatedCompanyCannotDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $company = factory(User::class)->create();
        $company->assignRole('company');
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($company)->delete(route('invoices.destroy', $invoice))
            ->assertStatus(403);
        $this->assertDatabaseHas('invoices', [
            'title' => $invoice->title,
            'code' => $invoice->code,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($treasurer)->delete(route('invoices.destroy', $invoice))
            ->assertStatus(403);
        $this->assertDatabaseHas('invoices', [
            'title' => $invoice->title,
            'code' => $invoice->code,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $invoice = factory(Invoice::class)->create(['client_id' => $client->id]);
        $this->actingAs($client->user)->delete(route('invoices.destroy', $invoice))
            ->assertStatus(403);
        $this->assertDatabaseHas('invoices', [
            'title' => $invoice->title,
            'code' => $invoice->code,
        ]);
    }
}
