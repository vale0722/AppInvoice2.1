<?php

namespace App\Imports\Sheets;

use App\Invoice;
use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class SecondSheetImport implements ToCollection, WithHeadingRow, WithBatchInserts
{
    use Importable;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['invoice_code'] == null) {
                break;
            }
            Validator::make($rows->toArray(), [
                '*.product_code' => 'exists:products,id|required',
                '*.invoice_code' => 'exists:invoices,code|required',
                '*.quantity' => 'required',
            ], [
                '*.product_code.exists' => 'El producto con :attribute no existe',
                '*.product_code.required' => 'El :attribute es un campo obligatorio',
                '*.invoice_code.exists' =>  'La factura con :attribute no existe',
                '*.invoice_code.required' =>  'El :attribute es un campo obligatorio',
                '*.quantity.required' =>  'El :attribute es un campo obligatorio',
            ], [
                '*.product_code' => 'Código = :input',
                '*.invoice_code' => 'Código = :input',
                '*.quantity' => 'Cantidad de productos',
            ])->validate();

            $codeInvoice = $row['invoice_code'];
            $codeProduct = $row['product_code'];
            $quantity = $row['quantity'];
            $invoice = Invoice::where('code', $codeInvoice)->first();
            $product = Invoice::where('code', $codeProduct)->first();
            $product = Product::find($codeProduct);
            $unitValue = $product->price;
            $totalValue = $quantity * $unitValue;
            $invoice->products()->attach($codeProduct, [
                'quantity' => $quantity,
                'unit_value' => $unitValue,
                'total_value' => $totalValue
            ]);
        }
    }
    public function batchSize(): int
    {
        return 100;
    }
}
