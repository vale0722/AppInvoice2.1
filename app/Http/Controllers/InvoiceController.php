<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use App\Imports\InvoiceImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Invoice;
use App\Client;
use App\Product;
use App\Company;
use App\Http\Requests\Invoices\InvoiceStoreRequest;
use App\User;

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
            ->creator()
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
    public function store(InvoiceStoreRequest $request)
    {
        $this->authorize('create', new Invoice());
        $invoice = new Invoice();
        $invoice->title = $request->input('title');
        $invoice->code = $request->input('code');
        $invoice->client_id = $request->input('client');
        $invoice->creator_id = auth()->user()->id;
        $invoice->state = "DEFAULT";
        $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        $invoice->save();
        return redirect()->route('invoices.edit', $invoice->id);
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
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $this->authorize('update', $invoice);
        if ($invoice->state != 'APPROVED' && $invoice->state != 'PENDING') {
            $validData = $request->validate([
                'title' => 'required',

                'code' => [
                    'required',
                    Rule::unique('invoices')->ignore($id)
                ],
                'client' => 'required|numeric|exists:clients,id',
                'stateReceipt' => 'required',
            ]);
            $invoice->title = $validData['title'];
            $invoice->code = $validData['code'];
            $invoice->client_id = $validData['client'];
            $invoice->creator_id = auth()->user()->id;
            $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
            if ($validData['stateReceipt'] == '1') {
                $now = new \DateTime();
                $invoice->receipt_date = $now->format('Y-m-d H:i:s');
            } else {
                $invoice->receipt_date = null;
            }
            $this->updateOrder($invoice);
            $invoice->save();
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
        return redirect()->route('invoices.edit', $invoice->id)->with('message', 'Registro de compra completado');
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
}
