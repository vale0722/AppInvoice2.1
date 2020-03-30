<?php

namespace App\Policies;

use App\Client;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Client $client = null)
    {
        if ($user->hasPermissionTo('clients.view')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the client can be shown to de user.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function show(User $user, Client $client)
    {
        return ($user->hasPermissionTo('clients.show'));
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Client $client)
    {
        return ($user->hasPermissionTo('clients.create'));
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        if ($user->hasPermissionTo('clients.update')) {
            return true;
        }
        if ($user->hasPermissionTo('clients.update.associated')) {
            if ($user->hasRole('client')) {
                return  $client->user->id == $user->id;
            }
            return  $client->creator_id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {
        if ($user->hasPermissionTo('clients.deleted')) {
            return true;
        }
        if ($user->hasPermissionTo('clients.delete.associated')) {
            return  $client->creator_id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can import clients.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function import(User $user, Client $client)
    {
        return ($user->hasPermissionTo('clients.import'));
    }

    /**
     * Determine whether the user can export clients.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function export(User $user, Client $client)
    {
        return ($user->hasPermissionTo('clients.export'));
    }
}
