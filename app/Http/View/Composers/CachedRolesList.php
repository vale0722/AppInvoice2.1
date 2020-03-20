<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CachedRolesList
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function compose(View $view)
    {
        $view->with('roles', Cache::remember('roles.enabled', 600, function () {
            return $this->role->all();
        }));
    }
}
