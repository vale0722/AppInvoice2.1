<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
    public function scopeSearch($query, $search, $type)
    {
        if ($type) {
            if ($search) {
                return $query->where("$type", 'LIKE', "%$search%");
            }
        }
    }
}
