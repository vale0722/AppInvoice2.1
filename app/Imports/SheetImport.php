<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class SheetImport implements WithMultipleSheets 
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            0 => new InvoiceImport(),
            1 => new SecondSheetImport()
        ];
    }
}