<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =
    [
        'invoice_id',
        'amount',
        'status',
        'request_id',
        'processUrl',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
