<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class UpdateInvoiceAction extends Action
{
    public function updateModel(Model $invoice, Request $request): Model
    {
        $invoice->title = $request->input('title');
        $invoice->code = $request->input('code');
        $invoice->client_id = $request->input('client');
        $invoice->creator_id = auth()->user()->id;
        $invoice->state = "DEFAULT";
        $invoice->duedate = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        if ($request->input('stateReceipt') == '1') {
            $now = new \DateTime();
            $invoice->receipt_date = $now->format('Y-m-d H:i:s');
        } else {
            $invoice->receipt_date = null;
        }
        $invoice->update();

        return $invoice;
    }
}
