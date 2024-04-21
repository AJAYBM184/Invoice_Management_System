
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const qtyInput = document.getElementById('qty');
  const amountInput = document.getElementById('amount');
  const taxPercentageSelect = document.getElementById('tax_percentage');
  const taxAmountInput = document.getElementById('tax_amount');
  const netAmountInput = document.getElementById('net_amount');

  // Function to calculate total amount
  function calculateTotalAmount() {
      const qty = parseFloat(qtyInput.value);
      const amount = parseFloat(amountInput.value);
      const totalAmount = qty * amount;
      document.getElementById('total_amount').value = totalAmount.toFixed(2);
      calculateTaxAmount();
  }

  // Function to calculate tax amount
  function calculateTaxAmount() {
      const taxPercentage = parseFloat(taxPercentageSelect.value);
      const totalAmount = parseFloat(document.getElementById('total_amount').value);
      const taxAmount = (totalAmount * taxPercentage) / 100;
      document.getElementById('tax_amount').value = taxAmount.toFixed(2);
      calculateNetAmount();
  }

  // Function to calculate net amount
  function calculateNetAmount() {
      const totalAmount = parseFloat(document.getElementById('total_amount').value);
      const taxAmount = parseFloat(document.getElementById('tax_amount').value);
      const netAmount = totalAmount + taxAmount;
      document.getElementById('net_amount').value = netAmount.toFixed(2);
  }

  // Event listeners for input changes
  qtyInput.addEventListener('input', calculateTotalAmount);
  amountInput.addEventListener('input', calculateTotalAmount);
  taxPercentageSelect.addEventListener('change', calculateTaxAmount);

  // Form validation
  const form = document.querySelector('form');

  form.addEventListener('submit', function(event) {
      if (!validateForm()) {
          event.preventDefault();
      }
  });

  function validateForm() {
      const qty = parseFloat(qtyInput.value);
      const amount = parseFloat(amountInput.value);
      const taxPercentage = parseFloat(taxPercentageSelect.value);
      const customerName = document.getElementById('customer_name').value;
      const invoiceDate = document.getElementById('invoice_date').value;
      const fileUpload = document.getElementById('file_path').value;
      const customerEmail = document.getElementById('customer_email').value;

      if (isNaN(qty) || qty <= 0) {
          alert('Quantity must be a positive number.');
          return false;
      }

      if (isNaN(amount) || amount <= 0) {
          alert('Amount must be a positive number.');
          return false;
      }

      if (isNaN(taxPercentage) || taxPercentage < 0) {
          alert('Tax percentage must be a non-negative number.');
          return false;
      }

      if (customerName.trim() === '') {
          alert('Please enter customer name.');
          return false;
      }

      if (invoiceDate.trim() === '') {
          alert('Please select invoice date.');
          return false;
      }

      if (fileUpload.trim() === '') {
          alert('Please upload a document.');
          return false;
      }

      if (customerEmail.trim() === '') {
          alert('Please enter customer email.');
          return false;
      }

      return true;
  }
});
