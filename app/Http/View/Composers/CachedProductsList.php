<?php

namespace App\Http\View\Composers;

use App\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CachedProductsList
{
    private $product;
    
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function compose(View $view)
    {
        $view->with('products', Cache::remember('products.enabled', 600, function() {
            return $this->product->all();
        }));
    }
}
