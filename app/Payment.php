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
        } else if ($status == 'OK') {
            $this->status = StatusAction::OK();
        } else if ($status == 'APPROVED') {
            $this->status = StatusAction::APPROVED();
        } else if ($status == 'APPROVED_PARTIAL') {
            $this->status = StatusAction::APPROVED_PARTIAL();
        } else if ($status == 'PARTIAL_EXPIRED') {
            $this->status = StatusAction::PARTIAL_EXPIRED();
        } else if ($status == 'REJECTED') {
            $this->status = StatusAction::REJECTED();
        } else if ($status == 'PENDING') {
            $this->status = StatusAction::PENDING();
        } else if ($status == 'PENDING_VALIDATION') {
            $this->status = StatusAction::PENDING_VALIDATION();
        } else {
            $this->status = StatusAction::BDEFAULT();
        }
    }
}
