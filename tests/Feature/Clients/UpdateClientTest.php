<?php

namespace Tests\Feature\Clients;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class UpdateClientTest extends RoleTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanEditViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->get(route('clients.edit', $client));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCanEditViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create(['creator_id' => $user->id]);
        $this->actingAs($user)->get(route('clients.edit', $client))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotEditViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $admin = factory(User::class)->create();
        $admin->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->get(route('clients.edit', $client))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotEditViewClient()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $clientUser = factory(Client::class)->create();
        $clientUser->user->assignRole('client');
        $client = factory(Client::class)->create();
        $this->actingAs($clientUser->user)->get(route('clients.edit', $client))->assertStatus(403);
        $this->assertAuthenticatedAs($clientUser->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanUpdateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->put(route('clients.update', $client), [
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
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyUpdateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->put(route('clients.update', $client), [
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
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotUpdateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $clientUser = factory(Client::class)->create();
        $clientUser->user->assignRole('client');
        $client = factory(Client::class)->create();
        $this->actingAs($clientUser->user)->put(route('clients.update', $client), [
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
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotUpdateAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($treasurer)->put(route('clients.update', $client), [
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
        ]);
    }
}
