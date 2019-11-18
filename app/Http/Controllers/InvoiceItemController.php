<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{InvoiceItem,Invoice};

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        return view ('invoiceItem.create',[
            'invoice' => $invoice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        $validData = $request->validate([
            'input_invoice_id' => 'required',
            'input_quantity' => 'required',
            'input_unit_value' => 'required',
            'input_description' => 'required'

        ]);
        $invoiceItem = new InvoiceItem();
        $invoiceItem->invoice_id = $validData['input_invoice_id'];
        $invoiceItem->quantity = $validData['input_quantity'];
        $invoiceItem->unit_value = $validData['input_unit_value'];
        $invoiceItem->description = $validData['input_description'];
        $invoiceItem->total_value = ($invoiceItem->quantity) * ($invoiceItem->unity_value);
        $invoiceItem->save();
        return redirect('/invoices/'. $invoice->id);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
