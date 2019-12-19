<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['title', 'code', 'client_id', 'company_id', 'duedate'];


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'unit_value', 'total_value']);
    }
    public function getSubtotalAttribute()
    {
        if (isset($this->products[0])) {
            return $this->products[0]->pivot->where('invoice_id', $this->id)->sum('total_value');
        } else {
            return 0;
        };
    }

    public function getVatAttribute()
    {
        $subtotal = $this->subtotal;
        return $subtotal * (.16);
    }

    public function getTotalAttribute()
    {
        $subtotal = $this->subtotal;
        $vat = $this->vat;
        return $subtotal + $vat;
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    //Query Scope

    public function scopeCode($query, $code)
    {
        if ($code)
            return $query->where('code', 'LIKE', "%$code%");
    }
    public function scopeTitle($query, $title)
    {
        if ($title)
            return $query->where('title', 'LIKE', "%$title%");
    }
}
