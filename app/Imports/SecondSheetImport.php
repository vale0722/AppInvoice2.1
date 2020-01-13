<?php

namespace App\Imports;

use App\{Invoice, Product};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class SecondSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        /* Validator::make($rows->toArray(), [
            'product_id' => 'required|exists:product, id',
            'invoice_id' => 'required|exists:invoice, id',
            'quantity' => 'required',
        ])->validate();
         */
        foreach ($rows as $row) {
            if ($row['invoice_id'] == null) {
                continue;
            }
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
}
