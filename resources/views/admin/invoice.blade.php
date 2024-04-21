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
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">{{ __('Add Invoices') }}</h1>
                    </div>
                    <hr />
                    <div class="mb-3">
                        <input id="search" type="text" class="form-control" placeholder="Search by customer details or invoice date">
                    </div>

                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Customer Email</th>
                                <th>Net Amount</th>
                                <th>Invoice Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->product_name }}</td>
                                    <td>{{ $invoice->customer_email }}</td>
                                    <td>{{ $invoice->net_amount }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{route('admin.dashboard.invoice.show', encrypt($invoice->id))}}" class="btn btn-primary" style="text-decoration: none; color: #fff;">Show</a>
                                        
                                        <a href="{{ route('admin.dashboard.invoice.edit',encrypt($invoice->id))}}" class="btn btn-secondary">Edit</a>

                                            <a href="{{route('admin.dashboard.invoice.destroy', encrypt($invoice->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</a>
 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
