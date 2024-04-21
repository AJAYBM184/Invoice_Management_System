<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('qty');
            $table->float('amount');
            $table->float('total_amount');
            $table->float('tax_percentage');
            $table->float('tax_amount');
            $table->float('net_amount');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('invoice_date');
            $table->string('file_path');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
