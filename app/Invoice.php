<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class);
    }

    public function Client(){
        return $this->belongTo(Client::class);
    }
}
