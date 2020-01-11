<?php 

namespace App\Imports;
use App\{Invoice, Product};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecondSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
     {
         foreach ($rows as $row) {
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
         return $invoice->products();
    }
}