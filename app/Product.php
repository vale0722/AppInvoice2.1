<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Invoices(){
        return $this->belongsToMany(Invoce::class);
    }
}
