<?php

namespace App\Http\View\Composers;

use App\Company;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CachedCompaniesList
{
    private $company;
    
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    public function compose(View $view)
    {
        $view->with('companies', Cache::remember('companies.enabled', 600, function() {
            return $this->company->all();
        }));
    }
}
