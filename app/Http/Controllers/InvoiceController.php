<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use App\Imports\InvoiceImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\{Invoice, Client, Product, Company};
use App\Http\Requests\Invoices\InvoiceStoreRequest;

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
            ->paginate(4);
        return view('invoice.index', [
            'clients' => Client::all(),
            'companies' => Company::all()
        ], compact('invoices', 'typeDate', 'firstCreationDate', 'type', 'finalCreationDate', 'state', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        return response()->view('invoice.create', [
            'invoice' => $invoice,
            'clients' => Client::all(),
            'companies' => Company::all()
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
        $invoice = new Invoice();
        $invoice->title = $request->input('title');
        $invoice->code = $request->input('code');
        $invoice->client_id = $request->input('client');
        $invoice->company_id = $request->input('company');
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
        return view('invoice.edit', [
            'invoice' => $invoice,
            'clients' => Client::all(),
            'companies' => Company::all()
        ]);
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
        $validData = $request->validate([
            'title' => 'required',

            'code' => [
                'required',
                Rule::unique('invoices')->ignore($id)
            ],
            'client' => 'required|numeric|exists:clients,id',
            'company' => 'required|numeric|exists:companies,id',
            'state' => 'required',
            'stateReceipt' => 'required',
        ]);
        $invoice = Invoice::find($id);
        $invoice->title = $validData['title'];
        $invoice->code = $validData['code'];
        $invoice->client_id = $validData['client'];
        $invoice->company_id = $validData['company'];
        $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        if ($validData['stateReceipt'] == '1') {
            $now = new \DateTime();
            $invoice->receipt_date = $now->format('Y-m-d H:i:s');
        } else {
            $invoice->receipt_date = NULL;
        }
        if ($validData['state'] == '1') {
            $now = new \DateTime();
            $invoice->state = $now->format('Y-m-d H:i:s');
            if ($validData['stateReceipt'] == '2') {
                $invoice->receipt_date = $now->format('Y-m-d H:i:s');
            }
        } else {
            $invoice->state = NULL;
        }
        $this->updateOrder($invoice);
        $invoice->save();
        return redirect()->route('invoices.index');
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
        $invoice->delete();

        return redirect()->route('invoices.index');
    }

    public function createInvoiceProduct($id)
    {
        $invoice = Invoice::find($id);
        return response()->view('invoiceProduct.create', compact('invoice'));
    }

    public function invoiceProductStore(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $validData = $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'unit_value' => 'required',
        ]);
        $product = Product::find($validData['product']);
        $validData['unit_value'] = $product->price;
        $invoice->products()->attach($validData['product'], [
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
        return view('invoice.importInvoice');
    }

    public function importExcel(Request $request)
    {
        if ($request->file('file')) {
            $file = $request->file('file')->getRealPath();
            $import = new InvoiceImport;
            $import->import($file);
            return redirect()->route('invoices.index')->with('message', 'Importación de facturas exítosa');
        } else {
            return back()->withErrors("Ingresa el archivo");
        }
    }

    public function exportExcel()
    {
        return Excel::download(new InvoiceExport, "invoice-list.xlsx");
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
