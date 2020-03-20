<?php

namespace App\Http\Controllers\Api;

use App\Invoice;
use App\Actions\StoreInvoiceAction;
use App\Actions\UpdateInvoiceAction;
use App\Http\Requests\Invoices\ApiInvoiceStoreRequest;
use App\Http\Requests\Invoices\ApiInvoiceUpdateRequest;

class InvoiceController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Invoice $invoice)
    {
        $this->authorize('viewAny', $invoice);
        $invoices = Invoice::creatorScp()->get();
        return $this->success($invoices);
    }

    public function store(ApiInvoiceStoreRequest $request, Invoice $invoice, StoreInvoiceAction $action)
    {
        $this->authorize('create', $invoice);
        return $action->storeModel($invoice, $request);
    }

    public function update(ApiInvoiceUpdateRequest $request, Invoice $invoice, UpdateInvoiceAction $action)
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
