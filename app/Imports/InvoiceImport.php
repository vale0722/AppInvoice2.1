<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvoiceImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
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
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:100',
            'code' => 'required|unique:invoices',
            'client_id' => 'required|numeric|exists:clients,id',
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'required' => "El :attribute de la factura es requerido",
            'code.unique' => 'El código de factura ya exíste',
            'client_id.exists' => 'El id del cliente no exíste',
            'company_id.exists' => 'El id de la compañia no exíste'
        ];
    }
}
