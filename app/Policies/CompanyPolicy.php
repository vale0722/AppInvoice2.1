<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->hasPermissionTo('view all company'));
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
        return ($user->hasPermissionTo('view associated company'));
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasPermissionTo('create company'));
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        return ($user->hasPermissionTo('update company'));
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        return ($user->hasPermissionTo('delete company'));
    }
}
