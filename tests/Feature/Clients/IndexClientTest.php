<?php

namespace Tests\Feature\CLients;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class IndexClientTest extends RoleTest
{
    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessTheIndexClientView()
    {
        // Unauthenticated user
        $response = $this->get(route('clients.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedAdminHasAccessClientList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user)->get(route('clients.index'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyHasAccessClientList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('clients.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerHasAccessClientList()
    {
        // Authenticated user
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $this->actingAs($user)->get(route('clients.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedClientHasAccessClientList()
    {
        // Authenticated user 
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->get(route('clients.index'))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanSeeTheClientList()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        factory(Client::class, 5)->create();
        $response = $this->actingAs($user)->get(route('clients.index'));
        $response->assertViewHas('clients');
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
        $response = $this->actingAs($user)->get(route('clients.index'));
        $response->assertViewHas('clients');
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
        $response = $this->actingAs($user)->get(route('clients.index'));
        $response->assertViewHas('clients');
    }
}
