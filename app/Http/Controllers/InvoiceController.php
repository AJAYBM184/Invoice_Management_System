<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Mail\SendInvoice;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }
    public function invoice()
    {
        $invoices = Invoice::all();
        return view('admin.invoice', compact('invoices'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_name'=>'required|string|max:255',
            'qty' => 'required|numeric|min:1',
            'amount' => 'required|numeric|min:0.01',
            'total_amount' => 'required|numeric|min:0.01',
            'tax_percentage' => 'required|numeric|min:0',
            'tax_amount' => 'required|numeric|min:0',
            'net_amount' => 'required|numeric|min:0.01',
            'customer_name' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'file_path' => 'required|file|mimes:jpg,png,pdf|max:3072',
            'customer_email' => 'required|email|max:255',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        } else {

            return redirect()->back()->withInput()->withErrors(['file_path' => 'Please upload a document.']);
        }

        $invoice = Invoice::create([
            'qty' => $validatedData['qty'],
            'product_name'=>$validatedData['product_name'],
            'amount' => $validatedData['amount'],
            'total_amount' => $validatedData['total_amount'],
            'tax_percentage' => $validatedData['tax_percentage'],
            'tax_amount' => $validatedData['tax_amount'],
            'net_amount' => $validatedData['net_amount'],
            'customer_name' => $validatedData['customer_name'],
            'invoice_date' => $validatedData['invoice_date'],
            'file_path' => $fileName,
            'customer_email' => $validatedData['customer_email'],
        ]);
        $recipientEmail = $invoice->customer_email;
        Mail::to($recipientEmail)->send(new InvoiceMail($invoice));

        return redirect()->route('admin.dashboard.invoice')->with('success', 'Invoice added successfully');
    }

    public function view()
    {
        $invoices = Invoice::all();
        return view('admin.invoice', compact('invoices'));
    }

    public function delete($id)
    {
        $invoice = Invoice::find(decrypt($id));
        $invoice->delete();
        return redirect()->route('admin.dashboard.invoice');
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail(decrypt($id));
        return view('admin.show_invoice', compact('invoice'));
    }
public function edit($id){
    $invoice = Invoice::findOrFail(decrypt($id));
    return view('admin.edit_invoice', compact('invoice'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'qty' => 'required|integer',
        'product_name' => 'required|string',
        'amount' => 'required|numeric',
        'total_amount' => 'required|numeric',
        'tax_percentage' => 'required|numeric',
        'tax_amount' => 'required|numeric',
        'net_amount' => 'required|numeric',
        'customer_name' => 'required|string',
        'customer_email' => 'required|email',
        'invoice_date' => 'required|date',
        'file_path' => 'nullable|file|mimes:jpg,png,pdf|max:3072',
    ]);

   
    $invoice = Invoice::findOrFail($id);

   
    if ($request->hasFile('file_path')) {
     
        $filePath = $request->file('file_path')->store('invoices');
        $invoice->file_path = $filePath;
    }

   
    $invoice->qty = $request->qty;
    $invoice->product_name = $request->product_name;
    $invoice->amount = $request->amount;
    $invoice->total_amount = $request->total_amount;
    $invoice->tax_percentage = $request->tax_percentage;
    $invoice->tax_amount = $request->tax_amount;
    $invoice->net_amount = $request->net_amount;
    $invoice->customer_name = $request->customer_name;
    $invoice->customer_email = $request->customer_email;
    $invoice->invoice_date = $request->invoice_date;

    $invoice->save();

    $recipientEmail = $invoice->customer_email;
    Mail::to($recipientEmail)->send(new InvoiceMail($invoice));

    return redirect()->route('admin.dashboard.invoice')->with('success', 'Invoice updated successfully.');
}






}
