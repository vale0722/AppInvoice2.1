<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment;
use Illuminate\Http\Request;
use App\Actions\StatusAction;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Invoice $invoice)
    {
        $this->authorize('invoices.view.payment.attempts', $invoice);
        return view("invoice.payment.index", compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $this->authorize('payment', $invoice);
        return view("invoice.payment.create", compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice, PlacetoPay $placetopay)
    {
        $this->authorize('payment', $invoice);
        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total
        ]);
        if ($invoice->total == 0) {
            $payment->status = StatusAction::NO_PRODUCTS();
            $invoice->state = $payment->status;
            $invoice->update();
            $payment->update();
            return redirect()->route('invoices.show', $invoice)->withErrors("No hay productos en la factura, vuelva a intentarlo");
        } elseif ($invoice->isApproved()) {
            return redirect()->route('invoices.show', $invoice)->withErrors("La factura ya está pagada");
        }

        $requestPayment = [
            'buyer' => [
                'name' => $invoice->client->user->name,
                'surname' => $invoice->client->user->lastname,
                'email' => $invoice->client->user->email,
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
                    'currency' => 'COP',
                    'total' => $invoice->total,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->header('User-Agent'),
            'returnUrl' => route('payments.show', $payment->id),
        ];
        $response = $placetopay->request($requestPayment);
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            $payment = Payment::where('id', $payment->id)->first();
            $payment->setStatus($response->status()->status());
            $invoice->state = $payment->status;
            $payment->request_id = $response->requestId();
            $payment->processUrl = $response->processUrl();
            $payment->update();
            $invoice->update();
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
     * @param  \Dnetix\Redirection\PlacetoPay $placetopay
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment, PlacetoPay $placetopay)
    {
        $payment = Payment::where('id', $payment->id)->first();
        $response = $placetopay->query($payment->request_id);
        $payment->setStatus($response->status()->status());
        $payment->update();
        $invoice = Invoice::where('id', $payment->invoice_id)->first();
        $this->authorize('invoices.view.payment.attempts', $invoice);
        if ($response->isSuccessful()) {
            $invoice->state = $payment->status;
            if ($response->status()->isApproved()) {
                $date = date("Y-m-d H:i:s", strtotime($response->status()->date()));
                if ($invoice->receipt_date == null) {
                    $invoice->receipt_date = $date;
                }
                $invoice->payment_date = $date;
                $payment->payment_date = $date;
                $payment->update();
            }
            $invoice->update();
        } else {
            $invoice->state = $payment->status;
            $invoice->receipt_date = null;
            $invoice->update();
        }
        return view("invoice.payment.index", compact('invoice'))->with('success', 'Actualizado');
    }
}
