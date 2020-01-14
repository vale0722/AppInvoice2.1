<?php

namespace App\Imports\Sheets;

use App\{Invoice, Product};
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
            if ($row['invoice_id'] == null) {
                continue;
            }
            Validator::make($rows->toArray(), [
                '*.product_id' => 'exists:products,id|required',
                '*.invoice_id' => 'exists:invoices,id|required',
                '*.quantity' => 'required',
            ], [
                '*.product_id.exists' => 'El producto con :attribute no existe',
                '*.invoice_id.exists' =>  'La factura con :attribute no existe',
                '*.product_id.required' => 'El :attribute es un campo obligatorio',
                '*.invoice_id.required' =>  'El :attribute es un campo obligatorio',
                '*.quantity.required' =>  'El :attribute es un campo obligatorio',
            ], [
                '*.product_id' => 'Id = :input',
                '*.invoice_id' => 'Id = :input',
                '*.quantity' => 'Cantidad de productos',
            ])->validate();

            $idInvoice = $row['invoice_id'];
            $idProduct = $row['product_id'];
            $quantity = $row['quantity'];
            $invoice = Invoice::find($idInvoice);
            $product = Product::find($idProduct);
            $unitValue = $product->price;
            $totalValue = $quantity * $unitValue;
            $invoice->products()->attach($idProduct, [
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
