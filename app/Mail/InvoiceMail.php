<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    /**
     * Create a new message instance.
     *
     * @param Invoice $invoice
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $file_path = public_path('uploads/' . $this->invoice->file_path);

        $file_name = basename($file_path); 

        return $this->view('emails.invoice')
                    ->subject('Invoice Mail')
                    ->with(['invoice' => $this->invoice]) 
                    ->attach($file_path, [
                        'as' => $file_name, 
                    ]);
    }
}
