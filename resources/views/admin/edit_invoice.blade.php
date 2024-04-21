<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 20px; gap: 20px;">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('admin.dashboard.invoice') }}">Invoices</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.dashboard.invoice.update', $invoice->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" name="qty" id="qty" class="form-control" required value="{{ $invoice->qty }}">
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" required value="{{ $invoice->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" required value="{{ $invoice->amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control" readonly value="{{ $invoice->total_amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="tax_percentage">Tax Percentage</label>
                                    <select name="tax_percentage" id="tax_percentage" class="form-control" required>
                                        <option value="0" {{ $invoice->tax_percentage == 0 ? 'selected' : '' }}>0%</option>
                                        <option value="5" {{ $invoice->tax_percentage == 5 ? 'selected' : '' }}>5%</option>
                                        <option value="12" {{ $invoice->tax_percentage == 12 ? 'selected' : '' }}>12%</option>
                                        <option value="18" {{ $invoice->tax_percentage == 18 ? 'selected' : '' }}>18%</option>
                                        <option value="28" {{ $invoice->tax_percentage == 28 ? 'selected' : '' }}>28%</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tax_amount">Tax Amount</label>
                                    <input type="text" name="tax_amount" id="tax_amount" class="form-control" readonly value="{{ $invoice->tax_amount }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="net_amount">Net Amount</label>
                                    <input type="text" name="net_amount" id="net_amount" class="form-control" readonly value="{{ $invoice->net_amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" pattern="[A-Za-z\s]+" required value="{{ $invoice->customer_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="invoice_date">Invoice Date</label>
                                    <input type="date" name="invoice_date" id="invoice_date" class="form-control" required value="{{ $invoice->invoice_date }}">
                                </div>
                                <div class="form-group">
    <label for="file_path">Upload Document</label>
    <input type="file" name="file_path" id="file_path" class="form-control-file" accept=".jpg, .png, .pdf">
</div>

                                <div class="form-group">
                                    <label for="customer_email">Customer Email</label>
                                    <input type="email" name="customer_email" id="customer_email" class="form-control" required value="{{ $invoice->customer_email }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/invoice.js') }}"></script>
