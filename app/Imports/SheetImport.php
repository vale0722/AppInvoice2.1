<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetImport implements WithMultipleSheets 
{

    public function Sheets(): array
    {
        return [
            0 => new InvoiceImport(),
            1 => new SecondSheetImport()
        ];
    }
}