<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use PHP_Token_ELSEIF;

class Invoice extends Model
{
    protected $fillable = ['title', 'code', 'client_id', 'creator_id', 'duedate', 'state'];


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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    //Query Scope
    public function scopeClient($query, $client)
    {
        if ($client) {
            return Invoice::whereHas(
                'client',
                function ($query) use ($client) {
                    $query->whereHas(
                        'user',
                        function ($queryUser) use ($client) {
                            $queryUser->where('name', 'LIKE', "%$client%");
                        }
                    );
                }
            );
        }
    }

    public function scopeSearch($query, $search, $type)
    {
        if ($type) {
            if ($search) {
                if ($type == 'client') {
                    return Invoice::scopeClient($query, $search);
                } else {
                    return $query->where("$type", 'LIKE', "%$search%");
                }
            }
        }
    }
    public function scopeFiltrateState($query, $state)
    {
        $now = new \DateTime();
        $now = $now->format('Y-m-d H:i:s');
        if ($state) {
            if ($state == "all") {
                return $query;
            } elseif ($state == "paid") {
                return $query->where("state", "APPROVED");
            } elseif ($state == "overdue") {
                return $query->where("duedate", "<=", "$now");
            } elseif ($state == "pending") {
                return $query->where("state", "PENDING");
            }
            {
                return $query->where("state", "!=", "APPROVED")->where("state", "!=", "PENDING");
            }
        }
    }
    public function scopeFiltrate($query, $typeDate, $firstCreationDate, $finalCreationDate)
    {
        if ($typeDate && $firstCreationDate && $finalCreationDate) {
            return $query->whereDate("$typeDate", ">=", "$firstCreationDate")->whereDate("$typeDate", '<=', "$finalCreationDate");
        }
    }

    public function scopeCreatorScp($query)
    {
        if (auth()->user()->hasPermissionTo('view all invoices')) {
            return $query;
        }
        if (auth()->user()->hasPermissionTo('view associated invoices')) {
            if (auth()->user()->hasRole('company')) {
                return $query->where('creator_id', auth()->user()->id);
            }
            if (auth()->user()->hasRole('client')) {
                return $query->where('client_id', auth()->user()->client->id);
            }
        }
        return;
    }
}
