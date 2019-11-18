<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Invoice, InvoiceItem};


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoice.index', [
            'invoice' => invoice::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validData = $request->validate([
            'input_title' => 'required'
        ]);
        $invoice = new Invoice();
        $invoice->title = $validData['input_title'];
        $invoice->save();

        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        'input_title' => 'required'
        ]);
        $invoice = Invoice::find($id);
        $invoice->title = $validData['input_title'];
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
    public function view($id){
        $invoice = Invoice::find($id);
        $invoiceItem = InvoiceItem::find($id);
        return view('invoiceItem.view',[
            'invoice' => $invoice,
            'invoiceItem' => $invoiceItem
        ]);
    }
    public function itemCreate($id){
        $invoice = Invoice::find($id);
        $invoiceItem = InvoiceItem::find($id);
        return view('invoiceItem.create',[
            'invoice' => $invoice,
            'invoiceItem' => $invoiceItem
        ]);
    }
}
