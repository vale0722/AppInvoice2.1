<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =
    [
        'name',
        'last_name',
        'id_type',
        'id_card',
        'email',
        'cellphone',
        'country',
        'city',
        'address'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
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
