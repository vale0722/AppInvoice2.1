<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use App\Company;
use App\Invoice;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;



    /**
     * @test
     */
    public function AuthenticatedUserCanSeeDetailsOfAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $response = $this->actingAs($user)->get(route('invoices.show', $invoice));
        $response->assertSuccessful();
        $response->assertSeeText($invoice->code);
        $response->assertSeeText($invoice->client->name);
        $response->assertSeeText($invoice->company->name);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanUpdateAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $client = factory(Client::class)->create();
        $company = factory(Company::class)->create();
        $this->actingAs($user)->put(route('invoices.update', $invoice), [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client' => $client->id,
            'company' => $company->id,
            'stateReceipt' => '2'
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('invoices', [
            'title' => 'Invoice',
            'code' => 'TestCode1',
            'client_id' => $client->id,
            'company_id' => $company->id,
        ]);
    }

    /**
     * @test
     */
    public function AuthenticatedUserCanDeleteAnInvoice()
    {
        $user = factory(User::class)->create();
        $this->seed("TypeDocumentSeeder");
        $invoice = factory(Invoice::class)->create();
        $this->actingAs($user)->delete(route('invoices.destroy', $invoice))
            ->assertRedirect(route('invoices.index'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('invoices', [
            'title' => $invoice->title,
            'code' => $invoice->code,
        ]);
    }
}
