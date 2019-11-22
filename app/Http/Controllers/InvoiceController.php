<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Invoice, Client, Product};


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
    public function index()
    {   
        return view('invoice.index', [
            'invoice' => Invoice::all(),
            'clients' => Client::all()
            
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create', [
            'invoice' => new invoice,
            'clients' => Client::all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validData = $request->validate([
            'title' => 'required',
            'code' => 'required',
            'client_id' => 'required'
        ]);

        $invoice = new Invoice();
        $invoice->title = $validData['title'];
        $invoice->code = $validData['code'];
        $invoice->client_id = $validData['client_id'];
        $invoice->save();
        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.show',[
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
        return view('invoice.edit',[
            'invoice' => $invoice
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
    {  $validData = $request->validate([
        'title' => 'required',
        'code' => 'required',
        'client_id' => 'required'
        ]);
        $invoice = Invoice::find($id);
        $invoice->title = $validData['title'];
        $invoice->code = $validData['code'];
        $invoice->client_id = $validData['client_id'];
        $invoice->save();

        return redirect('/invoices');
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

        return redirect('/invoices');
    }

    public function confirmDelete($id){
        $invoice = Invoice::find($id);
        return view('invoice.confirmDelete',[
            'invoice' => $invoice
        ]);
    }
    public function createInvoice_product($id){
        $invoice = Invoice::find($id);
        return view('invoice_product.create',[
            'invoice' => $invoice,
            'products' => Product::all(),
            'clients' => Client::all()
        ]);
    }
    public function invoice_productStore(Request $request, $id){
        $invoice = Invoice::find($id);
        $validData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'unit_value' => 'required'
        ]);
        
        $invoice->products()->attach($validData['product_id'], [
        'quantity'=>$validData['quantity'],
        'unit_value'=>$validData['unit_value'],
        'total_value'=>$validData['quantity']*$validData['unit_value']
        ]);
        return redirect('/invoices/'. $invoice->id);
    }
}
