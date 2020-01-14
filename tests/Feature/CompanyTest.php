<?php

namespace Tests\Feature;

use App\User;
use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * @test
     */
    public function UnauthenticatedUserCannotAccessCompanyList()
    {
        $response = $this->get(route('companies.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function AuthenticatedUserHasAccessCompanyList()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('companies.index'))->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanCreateACompany()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('companies.store'), [
            'name' => 'test name company',
            'nit' => 'i1234565486'
        ])
            ->assertRedirect(route('companies.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', [
            'name' => 'test name company',
            'nit' => 'i1234565486'
        ]);
    }

     /**
     * @test
     */
    public function AuthenticatedUserCanUpdateACompany()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->put(route('companies.update', $company), [
            'name' => 'test name company',
            'nit' => 'i1234565486'
        ])
            ->assertRedirect(route('companies.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', [
            'name' => 'test name company',
            'nit' => 'i1234565486'
        ]);
    }

    /** 
     * @test
     */
    public function AuthenticatedUserCanDeleteACompany()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->delete(route('companies.destroy', $company))
            ->assertRedirect(route('companies.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('companies', [
            'name' => $company->name,
            'nit' => $company->nit,
        ]);
    }
}
