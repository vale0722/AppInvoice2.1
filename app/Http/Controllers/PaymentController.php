<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        return view("invoice.payment.create", compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection/',
        ]);

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total
        ]);
        $request2 = [
            'buyer' => [
                'name' => $invoice->client->name,
                'surname' => $invoice->client->last_name,
                'email' => $invoice->client->email,
                'documentType' => $invoice->client->id_type,
                'document' => $invoice->client->id_card,
                'mobile' => $invoice->client->cellphone,
                'address' => [
                    'street' => $invoice->client->address,
                ]
            ],
            'payment' => [
                'reference' => $invoice->code,
                'description' => $invoice->title,
                'amount' => [
                    'currency' => 'COP', // crear esto en la tabla
                    'total' => $invoice->total,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->header('User-Agent'),
            'returnUrl' => route('payments.show', $payment->id),
        ];
        $response = $placetopay->request($request2);
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            $payment = Payment::where('id', $payment->id)->first();
            $payment->status = $response->status()->message();
            $payment->request_id = $response->requestId();
            $payment->processUrl = $response->processUrl();
            $payment->update();
            // Redirect the client to the processUrl or display it on the JS extension
            return redirect($response->processUrl());
        } else {
            // There was some error so check the message and log it
            $response->status()->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection/',
        ]);

        $response = $placetopay->query($payment->request_id);
        $payment = Payment::where('id', $payment->id)->first();
        $payment->status = $response->status()->status();
        $payment->update();
        $invoice = Invoice::where('id', $payment->invoice_id)->first();
        if ($response->isSuccessful()) {
            if ($response->status()->isApproved()) {
                $date = date("Y-m-d H:i:s", strtotime($response->status()->date()));
                $invoice->state = $date;
                if($invoice->receipt_date == NULL){
                    $invoice->receipt_date = $date;
                }
                $payment->payment_date = $date;
                $invoice->update();
                $payment->update();
            }
        } else {
            $invoice->state = NULL;
            $invoice->receipt_date = NULL;
            $invoice->update();
        }
        return view("invoice.payment.show", compact('payment', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
