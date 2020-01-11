<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class InvoiceImport implements ToModel, WithHeadingRow
{
     /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $invoice = new Invoice([
            'title'     => $row['title'],
            'code'    => $row['code'],
            'client_id' => $row['client_id'],
            'company_id' => $row['company_id'],
        ]);
        $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        return $invoice;
    }
}
   