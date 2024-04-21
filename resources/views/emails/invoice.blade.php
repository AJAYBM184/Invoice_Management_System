<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
</head>

<body>
  <section class="py-3 py-md-5">
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-6">
          <a href="{{ route('admin.dashboard.invoice') }}" class="btn btn-secondary">Back</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h3>From:</h3>
          <address>
            <strong>ABC Company</strong><br>

          </address>
        </div>
        <div class="col-md-6 text-md-end">
          <h3>Invoice #{{ $invoice->id }}</h3>
          <p>Invoice Date: {{ $invoice->invoice_date }}</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h3>To:</h3>
          <address>
            <strong>{{ $invoice->customer_name }}</strong><br>
          </address>
        </div>
        <div class="col-md-6 text-md-end">
          <h3>Payment Details:</h3>
          <p>Customer Email: {{ $invoice->customer_email }}</p>

        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <h3>Invoice Details</h3>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Unit Price</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $invoice->qty }}</td>
                  <td>{{ $invoice->product_name }}</td>
                  <td>${{ $invoice->amount }}</td>
                  <td>${{ $invoice->total_amount }}</td>
                </tr>
                <!-- Add more rows if necessary -->
                <tr>
                  <td colspan="3" class="text-end">Subtotal</td>
                  <td>${{ $invoice->total_amount }}</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end">Tax</td>
                  <td>${{ $invoice->tax_amount }}</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end">Total</td>
                  <td>${{ $invoice->net_amount }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">

      </div>
    </div>
  </section>
</body>

</html>