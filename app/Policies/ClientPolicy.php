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
    public function viewAny(User $user, Client $client)
    {
        if ($user->hasPermissionTo('view all clients') || $user->hasPermissionTo('view associated clients')) {
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
        return ($user->hasPermissionTo('show client'));
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Client $client)
    {
        return ($user->hasPermissionTo('create client'));
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
        if ($user->hasPermissionTo('update client')) {
            return true;
        }
        if ($user->hasPermissionTo('update associated client')) {
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
        if ($user->hasPermissionTo('delete client')) {
            return true;
        }
        if ($user->hasPermissionTo('delete associated client')) {
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
        return ($user->hasPermissionTo('import clients'));
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
        return ($user->hasPermissionTo('export clients'));
    }
}
