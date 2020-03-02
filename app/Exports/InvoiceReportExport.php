<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class InvoiceReportExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public function __construct(string $state, string $firstCreationDate, string $finalCreationDate)
    {
        $this->firstCreationDate = $firstCreationDate;
        $this->finalCreationDate = $finalCreationDate;
        $this->state = $state;
    }

    public function query()
    {
        if ($this->firstCreationDate != null & $this->finalCreationDate != null & $this->state != null) {
            if ($this->state == "paid") {
                return Invoice::query()
                    ->whereDate("created_at", ">=", "$this->firstCreationDate")
                    ->whereDate("created_at", '<=', "$this->finalCreationDate")
                    ->where("state", "APPROVED");
            } elseif ($this->state == "overdue") {
                $now = new \DateTime();
                $now = $now->format('Y-m-d H:i:s');
                return Invoice::query()
                    ->whereDate("created_at", ">=", "$this->firstCreationDate")
                    ->whereDate("created_at", '<=', "$this->finalCreationDate")
                    ->where("duedate", "<=", "$now");
            } elseif ($this->state == "pending") {
                return Invoice::query()
                    ->whereDate("created_at", ">=", "$this->firstCreationDate")
                    ->whereDate("created_at", '<=', "$this->finalCreationDate")
                    ->where("state", "PENDING");
            } else {
                return Invoice::query()
                    ->whereDate("created_at", ">=", "$this->firstCreationDate")
                    ->whereDate("created_at", '<=', "$this->finalCreationDate")
                    ->where("state", "!=", "APPROVED");
            }
        } elseif ($this->firstCreationDate != null & $this->finalCreationDate != null & $this->state == null) {
            return Invoice::query()
                ->whereDate("created_at", ">=", "$this->firstCreationDate")
                ->whereDate("created_at", '<=', "$this->finalCreationDate");
        } elseif ($this->state != null) {
            if ($state == "paid") {
                return Invoice::query()->where("state", "APPROVED");
            } elseif ($this->state == "overdue") {
                $now = new \DateTime();
                $now = $now->format('Y-m-d H:i:s');
                return Invoice::query()->where("duedate", "<=", "$now");
            } elseif ($this->state == "pending") {
                return Invoice::query()->where("state", "PENDING");
            } else {
                return Invoice::query()->where("state", "!=", "APPROVED");
            }
        }
    }
}
