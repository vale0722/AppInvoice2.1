<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class InvoiceReportExport implements FromQuery, ShouldQueue
{
    use Exportable, InteractsWithQueue, Queueable;

    public function __construct(string $state, string $firstCreationDate, string $finalCreationDate)
    {
        $this->firstCreationDate = $firstCreationDate;
        $this->finalCreationDate = $finalCreationDate;
        $this->state = $state;
    }

    public function query()
    {
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
                ->where("state", "!=", "APPROVED")
                ->where("state", "!=", "PENDING");
        }
    }
}
