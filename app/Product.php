<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function invoices(){
        return $this->belongsToMany(Invoice::class);
    }
}

?>