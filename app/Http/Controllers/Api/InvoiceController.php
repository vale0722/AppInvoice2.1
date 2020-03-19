<?php

namespace App\Http\Controllers\Api;

use App\Invoice;
use Illuminate\Http\Request;
use App\Actions\StoreInvoiceAction;
use App\Actions\UpdateInvoiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\InvoiceStoreRequest;
use App\Http\Requests\Invoices\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Invoice $invoice)
    {
        $this->authorize('viewAny', $invoice);
        return Invoice::all();
    }

    public function store(InvoiceStoreRequest $request, Invoice $invoice, StoreInvoiceAction $action)
    {
        $this->authorize('create', $invoice);
        return $action->storeModel($invoice, $request);
    }

    public function update(InvoiceUpdateRequest $request, Invoice $invoice, UpdateInvoiceAction $action)
    {
        $this->authorize('update', $invoice);
        return $action->updateModel($invoice, $request);
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('show', $invoice);
        return $invoice;
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        $invoice->delete();
        return __('La factura se ha eliminado');
    }
}
