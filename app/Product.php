<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< Updated upstream
    public function Invoices(){
        return $this->belongsToMany(Invoce::class);
=======
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
>>>>>>> Stashed changes
    }
}
