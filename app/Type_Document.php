<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Type_Document extends Model
{
    public function __construct()
    {
        Artisan::call('cache:clear');
    }
}
