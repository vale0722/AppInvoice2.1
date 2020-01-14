<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessProductList()
    {
        $response = $this->get(route('products.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessProductList()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('products.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanCreateAnProduct()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('products.store'), [
            'code' => 'p1',
            'price' => '100',
            'name' => 'test product'
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('products', [
            'code' => 'p1',
            'price' => '100',
            'name' => 'test product'
        ]);
    }
}
