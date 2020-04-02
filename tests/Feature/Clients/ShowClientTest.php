<?php

namespace Tests\Feature\Clients;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class ShowClientTest extends RoleTest
{
    /**
     * @test
     */
    public function AuthenticatedAdminCanSeeDetailsOfAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $response = $this->actingAs($user)->get(route('clients.show', $client));
        $response->assertSuccessful();
        $response->assertSeeText($client->name);
        $response->assertSeeText($client->id_type);
        $response->assertSeeText($client->id_card);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanSeeDetailsOfAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $response = $this->actingAs($user)->get(route('clients.show', $client));
        $response->assertSuccessful();
        $response->assertSeeText($client->name);
        $response->assertSeeText($client->id_type);
        $response->assertSeeText($client->id_card);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotSeeDetailsOfAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $clientUser = factory(Client::class)->create();
        $clientUser->user->assignRole('client');
        $client = factory(Client::class)->create();
        $response = $this->actingAs($clientUser->user)->get(route('clients.show', $client));
        $response->assertStatus(403);
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
        $client = factory(Client::class)->create();
        $response = $this->actingAs($treasurer)->get(route('clients.show', $client));
        $response->assertSuccessful();
        $response->assertSeeText($client->name);
        $response->assertSeeText($client->id_type);
        $response->assertSeeText($client->id_card);
    }
}
