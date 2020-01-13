<?php

namespace App\Imports;

use App\{Invoice, Product};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SecondSheetImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['invoice_id']==null) {
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
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric',
            'idInvoice' => 'required|numeric|exists:invoice,id',
            'idProduct' => 'required|numeric|exists:product,id',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'required' => "El :attribute de la factura es requerido",
            'idInvoice.exists' => 'El id de la factura no exíste',
            'idProduct.exists' => 'El id del producto no exíste'
        ];
    }

}
