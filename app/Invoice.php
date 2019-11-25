<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot(['quantity','unit_value','total_value']);
    }

    public function getSubtotalAttribute(){
        if(isset($this->products[0])){
            return $this->products[0]->pivot->where('invoice_id', $this->id)->sum('total_value');
        }else{
            return 0;
        };
    }

    public function getVatAttribute(){
        $subtotal = $this->subtotal;
        return $subtotal * (.16); 
    }
    
    public function getTotalAttribute(){
        $subtotal = $this->subtotal;
        $vat = $this->vat;
        return $subtotal + $vat; 
    }

    public function Client(){
        return $this->belongsTo(Client::class);
    }
    public function Company(){
        return $this->belongsTo(Company::class);
    }
}
