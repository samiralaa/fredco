<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController 
{

    public function index()
{
    $invoices = Invoice::get(); 
    return response()->json($invoices);
}


    public function store(Request $request)
    {
        $invoice = Invoice::create($request->only([
            'client_name',
             'client_location', 
             'client_address',
            'created_date', 
            'due_date',
             'total'
        ]));

        foreach ($request->items as $item) {
            $invoice->items()->create($item);
        }

        return response()->json($invoice->load('items'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return response()->json($invoice);
    }
    public function update(Request $request, $id){
        $invoice = Invoice::findOrFail($id);
     
    }
    public function destroy($id){
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return response()->json("deleted");    }
}
