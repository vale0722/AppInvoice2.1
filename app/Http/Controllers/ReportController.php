<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\Exports\InvoiceReportExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('export', new Invoice());
        $firstCreationDate = $request->get('firstCreationDate');
        $finalCreationDate = $request->get('finalCreationDate');
        $state = $request->get('state');
        $invoices = Invoice::orderBy('id', 'DESC')
            ->filtrate('created_at', $firstCreationDate, $finalCreationDate)
            ->filtrateState($state)
            ->paginate(10);

        return view('report.index', compact('invoices', 'firstCreationDate', 'finalCreationDate', 'state'));
    }

    public function export(Request $request, $firstCreationDate, $finalCreationDate, $format, $state)
    {
        $this->authorize('export', new Invoice());
        return (new InvoiceReportExport($firstCreationDate, $finalCreationDate, $state))->download('invoices.' . $format);
    }
}
