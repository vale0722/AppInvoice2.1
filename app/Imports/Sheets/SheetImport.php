<?php

namespace App\Imports\Sheets;

use App\Invoice;
use App\Actions\StatusAction;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class SheetImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts
{
    use Importable;
    private $rows = 0;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        ++$this->rows;
        $invoice = new Invoice([
            'title'     => $row['title'],
            'code'    => $row['code'],
            'client_id' => $row['client_id'],
            'creator_id' => auth()->user()->id,
            'state' => StatusAction::BDEFAULT(),
        ]);
        $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        Cache::put('rows', $this->rows, 10);
        return $invoice;
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
    public function batchSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:100',
            'code' => 'required|unique:invoices',
            'client_id' => 'required|numeric|exists:clients,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'required' => "El :attribute de la factura es requerido",
            'code.unique' => 'El código de factura ya exíste',
            'client_id.exists' => 'El id del cliente no exíste'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            'title' => 'Título',
            'code' => 'Código',
            'client_id' => 'Id del Cliente',
        ];
    }
}
