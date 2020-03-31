<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\Exports\InvoiceReportExport;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Jobs\Saludar;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

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

    public function show()
    {

        $this->authorize('export', new Invoice());
        $reports = Auth::user()->notifications;
        return view('report.show', compact('reports'));
    }

    public function delete($id)
    {
        $this->authorize('export', new Invoice());
        foreach (Auth::user()->notifications as $notification) {
            if ($notification->id == $id) {
                $notification->delete();
                return redirect()->route('report.show');
            }
        }
    }

    public function export(Request $request, $firstCreationDate, $finalCreationDate, $format, $state)
    {
        $this->authorize('export', new Invoice());
        $now = new \DateTime();
        $now = $now->format('Y-m-d H-i-s');
        $file = 'invoices ' . $now . '.' . $format;
        $link = asset('storage/' . $file);
        (new InvoiceReportExport($firstCreationDate, $finalCreationDate, $state))->store($file, 'public')->chain([
            new NotifyUserOfCompletedExport(auth()->user(), $link, $format, $firstCreationDate, $finalCreationDate, $state)
        ]);
        $request = [
            'firstCreationDate' => $firstCreationDate,
            'finalCreationDate' => $finalCreationDate,
            'state' => $state,
        ];
        return redirect()->route('report.index', $request)->with('exportInProccess', 'En proceso');
    }
}
