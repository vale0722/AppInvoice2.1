<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use PHP_Token_ELSEIF;

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
    public function scopeClient($query, $client)
    {
        if ($client)
            return Invoice::whereHas(
                'Client',
                function ($query) use ($client) {
                    $query->where('name', 'LIKE', "%$client%");
                }
            );
    }
    public function scopeCompany($query, $company)
    {
        if ($company)
            return Invoice::whereHas(
                'Company',
                function ($query) use ($company) {
                    $query->where('name', 'LIKE', "%$company%");
                }
            );
    }
    public function scopeSearch($query, $search, $type)
    {
        if ($type)
            if ($search)
                if ($type == 'client')
                    return Invoice::scopeClient($query, $search);
                elseif ($type == 'company')
                    return Invoice::scopeCompany($query, $search);
                else
                    return $query->where("$type", 'LIKE', "%$search%");
    }
    public function scopeFiltrateState($query, $state)
    {
        $now = new \DateTime();
        $now = $now->format('Y-m-d H:i:s');
        if ($state)
            if ($state == "paid")
                return $query->where("state", "!=", "NULL");
            elseif ($state == "overdue")
                return $query->where("duedate", "<=", "$now");
            else
                return $query->where("state");
    }
    public function scopeFiltrate($query, $typeDate, $firstCreationDate, $finalCreationDate)
    {
        $now = new \DateTime();
        $now = $now->format('Y-m-d H:i:s');
        if ($typeDate)
            return $query->whereDate("$typeDate", ">=", "$firstCreationDate")->whereDate("$typeDate", '<=', "$finalCreationDate");
    }
}
