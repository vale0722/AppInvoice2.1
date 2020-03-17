<?php

namespace App\Policies;

use App\Company;
use App\Invoice;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any invoices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Invoice $invoice = NULL)
    {
        if ($user->hasPermissionTo('view all invoices') || $user->hasPermissionTo('view associated invoices')) {
            return true;
        }
        return false;
    }


    /**
     * Determine whether the company can be shown to de user.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function show(User $user, Invoice $invoice)
    {
        if ($user->hasPermissionTo('show invoice')) {
            if ($user->hasRole('company')) {
                return  $invoice->creator_id == $user->id;
            }
            if ($user->hasRole('client')) {
                return  $invoice->client->user->id == $user->id;
            }
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can create invoices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasPermissionTo('create invoice'));
    }

    /**
     * Determine whether the user can update the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function update(User $user, Invoice $invoice)
    {
        if ($user->hasPermissionTo('update invoice')) {
            return true;
        }
        if ($user->hasPermissionTo('update associated invoice')) {
            return  $invoice->creator_id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function delete(User $user, Invoice $invoice)
    {
        return ($user->hasPermissionTo('delete invoice'));
    }

    /**
     * Determine whether the user can payment the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function payment(User $user, Invoice $invoice)
    {
        if ($user->hasPermissionTo('pay invoice')) {
            return  $invoice->client->user->id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can view payment attempts of the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function paymentView(User $user, Invoice $invoice)
    {
        if ($user->hasPermissionTo('view payment attempts')) {
            if ($user->hasRole('company')) {
                return  $invoice->creator_id == $user->id;
            }
            if ($user->hasRole('client')) {
                return  $invoice->client->user->id == $user->id;
            }
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can import invoices.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function import(User $user, Invoice $invoice)
    {
        return ($user->hasPermissionTo('import invoices'));
    }

    /**
     * Determine whether the user can export invoices.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function export(User $user, Invoice $invoice)
    {
        return ($user->hasPermissionTo('export invoices'));
    }
}
