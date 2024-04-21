<?php
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('admin/dashboard', [InvoiceController::class, 'index'])->name('admin.dashboard.index');

Route::get('admin/dashboard/invoice', [InvoiceController::class, 'invoice'])->name('admin.dashboard.invoice');


Route::post('admin/dashboard/store', [InvoiceController::class, 'store'])->name('invoices.store');

Route::get('admin/dashboard/invoice/{id}', [InvoiceController::class, 'delete'])->name('admin.dashboard.invoice.destroy');

Route::get('admin/dashboard/invoice_show/{id}', [InvoiceController::class, 'show'])->name('admin.dashboard.invoice.show');

Route::get('admin/dashboard/invoice_edit/{id}', [InvoiceController::class, 'edit'])->name('admin.dashboard.invoice.edit');

Route::put('admin/dashboard/invoice_update/{id}', [InvoiceController::class, 'update'])->name('admin.dashboard.invoice.update');









