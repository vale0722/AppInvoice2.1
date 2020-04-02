<?php

namespace Tests\Feature\Invoices;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class ImportInvoiceTest extends RoleTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanImportViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user)->get(route('invoices.import.view'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCanImportViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('invoices.import.view'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotImportViewInvoice()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $this->actingAs($user)->get(route('invoices.import.view'))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotImportViewInvoice()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->get(route('invoices.import.view'))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }
}
