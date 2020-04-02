<?php

namespace Tests\Feature\Clients;

use App\User;
use App\Client;
use Tests\Feature\RoleTest;

class DeleteClientTest extends RoleTest
{
    /**
     * @test
     */
    public function anAuthenticatedAdminCanConfirmDeleteViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->get(route('clients.confirm.delete', $client));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCannotConfirmDeleteViewForeingClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->actingAs($user)->get(route('clients.confirm.delete', $client))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedCompanyCanConfirmDeleteViewAssociatedClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('company');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create(['creator_id' => $user->id]);
        $this->actingAs($user)->get(route('clients.confirm.delete', $client));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedTreasurerCannotConfirmDeleteViewClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('treasurer');
        $admin = factory(User::class)->create();
        $admin->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->get(route('clients.confirm.delete', $client))->assertStatus(403);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function anAuthenticatedClientCannotConfirmDeleteViewClient()
    {
        $this->seed("TypeDocumentSeeder");
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $clientUser = factory(Client::class)->create();
        $clientUser->user->assignRole('client');
        $client = factory(Client::class)->create();
        $this->actingAs($clientUser->user)->get(route('clients.confirm.delete', $client))->assertStatus(403);
        $this->assertAuthenticatedAs($clientUser->user);
    }

    /**
     * @test
     */
    public function AuthenticatedAdminCanDeleteAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($user)->delete(route('clients.destroy', $client))
            ->assertRedirect(route('clients.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('clients', [
            'id_type' => $client->id_type,
            'id_card' => $client->id_card,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCanDeleteAssociatedClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $company = factory(User::class)->create();
        $company->assignRole('company');
        $client = factory(Client::class)->create(['creator_id' => $company->id]);
        $this->actingAs($company)->delete(route('clients.destroy', $client))
            ->assertRedirect(route('clients.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('clients', [
            'id_type' => $client->id_type,
            'id_card' => $client->id_card,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedCompanyCannotDeleteAForeignClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $company = factory(User::class)->create();
        $company->assignRole('company');
        $this->actingAs($company)->delete(route('clients.destroy', $client))
            ->assertStatus(403);
        $this->assertDatabaseHas('clients', [
            'id_type' => $client->id_type,
            'id_card' => $client->id_card,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedTreasurerCannotDeleteAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $treasurer = factory(User::class)->create();
        $treasurer->assignRole('treasurer');
        $this->seed("TypeDocumentSeeder");
        $client = factory(Client::class)->create();
        $this->actingAs($treasurer)->delete(route('clients.destroy', $client))
            ->assertStatus(403);
        $this->assertDatabaseHas('clients', [
            'id_type' => $client->id_type,
            'id_card' => $client->id_card,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedClientCannotDeleteAClient()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->seed("TypeDocumentSeeder");
        $clientUser = factory(Client::class)->create();
        $clientUser->user->assignRole('client');
        $client = factory(Client::class)->create();
        $this->actingAs($clientUser->user)->delete(route('clients.destroy', $client))
            ->assertStatus(403);
        $this->assertDatabaseHas('clients', [
            'id_type' => $client->id_type,
            'id_card' => $client->id_card,
        ]);
    }
}
