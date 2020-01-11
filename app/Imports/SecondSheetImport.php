<?php 

namespace App\Imports;
use App\{Invoice, Product};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SecondSheetImport implements ToCollection
{
    public function collection(Collection $rows)
     {
         foreach ($rows as $row) {
            $idInvoice = $row[0];
            $idProduct = $row[1];
            $quantity = $row[2];
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