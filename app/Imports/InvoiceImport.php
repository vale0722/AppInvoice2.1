<?php

namespace App\Imports;
use App\Imports\Sheets\SecondSheetImport;
use App\Imports\Sheets\SheetImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InvoiceImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use Importable;

    public function Sheets(): array
    {
        return [
            0 => new SheetImport(),
            1 => new SecondSheetImport()
        ];
    }
    
    public function onUnknownSheet($sheetName)
    {
        
        info("Se omitió la hoja {$sheetName}");
    }
}
