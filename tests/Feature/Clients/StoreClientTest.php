<?php

namespace Tests\Feature\Clients;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class StoreClientTest extends RoleTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanCreateViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user)->get(route('clients.create'));
        $this->assertAuthenticatedAs($user);
    }
    /**
     * @test
     */
    public function anAuthenticatedCompanyCanCreateViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('clients.create'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCanCreateViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $this->actingAs($user)->get(route('clients.create'))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotCreateViewClient()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->get(route('clients.create'))->assertStatus(403);
        $this->assertAuthenticatedAs($client->user);
    }

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotStoreAClient()
    {
        $response = $this->post(route('clients.store'), []);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanCreateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $this->actingAs($user)->post(route('clients.store'), [
            'name' => 'client Test',
            'lastname' => 'client Test',
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'email' => 'clientTest@mail.com',
            'cellphone' => '1234567840',
            'country' => 'Country test',
            'department' => 'Department Test',
            'city' => 'City Test',
            'address' => 'Address - test'
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('clients', [
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanCreateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $this->actingAs($user)->post(route('clients.store'), [
            'name' => 'client Test',
            'lastname' => 'client Test',
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'email' => 'clientTest@mail.com',
            'cellphone' => '1234567840',
            'country' => 'Country test',
            'department' => 'Department Test',
            'city' => 'City Test',
            'address' => 'Address - test'
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('clients', [
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'creator_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotCreateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->actingAs($treasurer)->post(route('clients.store'), [
            'name' => 'client Test',
            'lastname' => 'client Test',
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'email' => 'clientTest@mail.com',
            'cellphone' => '1234567840',
            'country' => 'Country test',
            'department' => 'Department Test',
            'city' => 'City Test',
            'address' => 'Address - test'
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('clients', [
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'creator_id' => $treasurer->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotCreateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $client->user->assignRole('client');
        $this->actingAs($client->user)->post(route('clients.store'), [
            'name' => 'client Test',
            'lastname' => 'client Test',
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'email' => 'clientTest@mail.com',
            'cellphone' => '1234567840',
            'country' => 'Country test',
            'department' => 'Department Test',
            'city' => 'City Test',
            'address' => 'Address - test'
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('clients', [
            'id_type' => 'cc',
            'id_card' => '1234567890',
            'creator_id' => $client->user->id,
        ]);
    }
}
