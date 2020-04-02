<?php

namespace App;

use App\Actions\StatusAction;
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
        return $this->belongsTo(Invoice::class);
    }

    public function setStatus(string $status): void
    {
        if ($status == 'FAILED') {
            $this->status = StatusAction::FAILED();
        } elseif ($status == 'OK') {
            $this->status = StatusAction::OK();
        } elseif ($status == 'APPROVED') {
            $this->status = StatusAction::APPROVED();
        } elseif ($status == 'APPROVED_PARTIAL') {
            $this->status = StatusAction::APPROVED_PARTIAL();
        } elseif ($status == 'PARTIAL_EXPIRED') {
            $this->status = StatusAction::PARTIAL_EXPIRED();
        } elseif ($status == 'REJECTED') {
            $this->status = StatusAction::REJECTED();
        } elseif ($status == 'PENDING') {
            $this->status = StatusAction::PENDING();
        } elseif ($status == 'PENDING_VALIDATION') {
            $this->status = StatusAction::PENDING_VALIDATION();
        } else {
            $this->status = StatusAction::BDEFAULT();
        }
    }
}
