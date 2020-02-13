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

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
