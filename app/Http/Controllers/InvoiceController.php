<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Company;
use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use App\Imports\InvoiceImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Actions\StoreInvoiceAction;
use App\Actions\UpdateInvoiceAction;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Invoices\InvoiceStoreRequest;
use App\Http\Requests\Invoices\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', new Invoice());
        $typeDate = $request->get('typeDate');
        $firstCreationDate = $request->get('firstCreationDate');
        $finalCreationDate = $request->get('finalCreationDate');
        $state = $request->get('state');
        $search = $request->get('search');
        $type = $request->get('type');
        $invoices = Invoice::orderBy('id', 'DESC')
            ->search($search, $type)
            ->filtrate($typeDate, $firstCreationDate, $finalCreationDate)
            ->filtrateState($state)
            ->creatorScp()
            ->paginate(10);
        $this->updateInvoices();
        return view('invoice.index', [
            'clients' => Client::all(),
        ], compact('invoices', 'typeDate', 'firstCreationDate', 'type', 'finalCreationDate', 'state', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $this->authorize('create', new Invoice());
        return response()->view('invoice.create', [
            'invoice' => $invoice,
            'clients' => Client::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request, StoreInvoiceAction $action)
    {
        $this->authorize('create', new Invoice());
        $invoice = new Invoice();
        $invoice = $action->storeModel($invoice, $request);
        return redirect()->route('invoices.edit', $invoice);
    }


    /**
     * Display the specified resource.
     *
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('show', $invoice);
        return view('invoice.show', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $this->authorize('update', $invoice);
        if ($invoice->state != 'APPROVED' && $invoice->state != 'PENDING') {
            return view('invoice.edit', [
                'invoice' => $invoice,
                'clients' => Client::all(),
            ]);
        }
        return redirect()->route('invoices.index')->with('errorEdit', 'LA FACTURA NO SE PUEDE EDITAR');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice, UpdateInvoiceAction $action)
    {
        $this->authorize('update', $invoice);
        if ($invoice->state != 'APPROVED' && $invoice->state != 'PENDING') {
            $invoice = $action->updateModel($invoice, $request);
            return redirect()->route('invoices.index');
        } else {
            return redirect()->route('invoices.index')->with('errorEdit', 'LA FACTURA NO SE PUEDE EDITAR');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $this->authorize('update', $invoice);
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function createInvoiceProduct($id)
    {
        $invoice = Invoice::find($id);
        $this->authorize('update', $invoice);
        return response()->view('invoiceProduct.create', compact('invoice'));
    }

    public function invoiceProductStore(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $this->authorize('update', $invoice);
        $validData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'unit_value' => 'required',
        ]);
        $product = Product::find($validData['product_id']);
        $validData['unit_value'] = $product->price;
        $invoice->products()->attach($validData['product_id'], [
            'quantity' => $validData['quantity'],
            'unit_value' => $validData['unit_value'],
            'total_value' => $validData['quantity'] * $validData['unit_value']
        ]);
        $this->updateOrder($invoice);
        $invoice->save();
        return redirect()->route('invoices.edit', $invoice)->with('message', 'Registro de compra completado');
    }

    public function indexImport()
    {
        $this->authorize('import', new Invoice());
        return view('invoice.importInvoice');
    }

    public function importExcel(Request $request)
    {
        $this->authorize('import', new Invoice());
        if ($request->file('file')) {
            $file = $request->file('file')->getRealPath();
            $import = new InvoiceImport;
            $import->import($file);
            $contImport = Cache::get('rows');
            return redirect()->route('invoices.index')->with('success', 'Importación de facturas exítosa, se importaron ' . $contImport . ' facturas');
        } else {
            return back()->withErrors("Ingresa el archivo");
        }
    }

    public function updateOrder(Invoice $invoice)
    {
        DB::table('invoices')->where('id', $invoice->id)->update(['subTotal' => $invoice->subTotal, 'vat' => $invoice->vat, 'total' => $invoice->total]);
    }

    public function updateInvoices()
    {
        $invoices = Invoice::all();
        foreach ($invoices as $invoice) {
            $this->updateOrder($invoice);
        }
        return back();
    }

    public function confirmDelete(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        return view('invoice.confirmDelete', [
            'invoice' => $invoice
        ]);
    }
}
