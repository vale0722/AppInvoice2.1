<?php

namespace App\Http\View\Composers;

use App\Type_Document;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CachedTypesDocumentsList
{
    private $product;
    
    public function __construct(Type_Document $typeDocument)
    {
        $this->typeDocument = $typeDocument;
    }
    public function compose(View $view)
    {
        $view->with('types_documents', Cache::remember('typesDocuments.enabled', 600, function () {
            return $this->typeDocument->all();
        }));
    }
}
