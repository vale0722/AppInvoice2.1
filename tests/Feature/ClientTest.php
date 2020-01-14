<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessClientList()
    {
        $response = $this->get(route('clients.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessClientList()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('clients.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanCreateAnClient()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('clients.store'), [
            'name' => 'test name',
            'last_name' => 'test lastname',
            'id_type' => 'cc',
            'id_card' => '12345678',
            'email' => 'correo@correo.com',
            'cellphone' => '1234567810',
            'country' => 'test country',
            'city' => 'test city',
            'address' => 'test address'
        ])
            ->assertRedirect(route('clients.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('clients', [
            'name' => 'test name',
            'last_name' => 'test lastname',
            'id_type' => 'cc',
            'id_card' => '12345678',
            'email' => 'correo@correo.com',
            'cellphone' => '1234567810',
            'country' => 'test country',
            'city' => 'test city',
            'address' => 'test address'
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanSeeDetailsOfAClient()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create();
        $response = $this->actingAs($user)->get(route('clients.show', $client));
        $response->assertSuccessful();
        $response->assertSeeText($client->name);
        $response->assertSeeText($client->email);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanUpdateAClient()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create();
        $this->actingAs($user)->put(route('clients.update', $client), [
            'name' => 'test name',
            'last_name' => 'test lastname',
            'id_type' => 'cc',
            'id_card' => '12345678',
            'email' => 'correo@correo.com',
            'cellphone' => '1234567810',
            'country' => 'test country',
            'city' => 'test city',
            'address' => 'test address'
        ])
            ->assertRedirect(route('clients.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('clients', [
            'name' => 'test name',
            'last_name' => 'test lastname',
            'id_type' => 'cc',
            'id_card' => '12345678',
            'email' => 'correo@correo.com',
            'cellphone' => '1234567810',
            'country' => 'test country',
            'city' => 'test city',
            'address' => 'test address'
        ]);
    }

    /** 
     * @test
     */
    public function AuthenticatedUserCanDeleteAClient()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create();
        $this->actingAs($user)->delete(route('clients.destroy', $client))
            ->assertRedirect(route('clients.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('clients', [
            'name' => $client->name,
            'id_card' => $client->id_card,
            'email' => $client->email,
        ]);
    }
}
