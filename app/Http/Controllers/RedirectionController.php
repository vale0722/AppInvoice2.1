<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Redirection;
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;

class RedirectionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        return view("invoice.redirection.create", compact('invoice'));
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
        
        $reference = $invoice->id;
        
       // REGISTRO EN LA BASE DE DATOS 

        $request2 = [
            "buyer" => [
                "name" => $invoice->client->name,
                "surname" => $invoice->client->last_name,
                "email" => $invoice->client->email,
                "documentType" => $invoice->client->id_type,
                "document" => $invoice->client->id_card,
                "mobile" => $invoice->client->cellphone,
                "address" => [
                    "street" => $invoice->client->address,
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
            'returnUrl' => route('redirection.show'), // la factura y El registro que voy a crear
        ];
        $response = $placetopay->request($request2);
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            return redirect()->away($response->processUrl());
        } else {
            // There was some error so check the message and log it
            $response->status()->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo ('Holi caracoli');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function edit(Redirection $redirection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redirection $redirection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redirection $redirection)
    {
        //
    }
}
