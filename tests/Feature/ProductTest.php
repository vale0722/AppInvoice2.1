<?php

namespace Tests\Feature;

use App\User;
use App\Product;
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

    /**
     * @test
     */
    public function AuthenticatedUserCanUpdateAProduct()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->put(route('products.update', $product), [
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

    /** 
     * @test
     */
    public function AuthenticatedUserCanDeleteACompany()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($user)->delete(route('products.destroy', $product))
            ->assertRedirect(route('products.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'code' => $product->code,
        ]);
    }
}
