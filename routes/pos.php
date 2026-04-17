<?php

use App\Http\Controllers\POS\CategoryController;
use App\Http\Controllers\POS\ProductController;
use App\Http\Controllers\POS\CustomerController;
use App\Http\Controllers\POS\SupplierController;
use App\Http\Controllers\POS\SaleInvoiceController;
use App\Http\Controllers\POS\PurchaseInvoiceController;
use App\Http\Controllers\POS\TreasuryController;
use App\Http\Controllers\POS\InstallmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->prefix('pos')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('sale-invoices', SaleInvoiceController::class)->except(['update', 'destroy']);
    Route::apiResource('purchase-invoices', PurchaseInvoiceController::class)->except(['update', 'destroy']);
    
    // Treasury
    Route::get('treasury', [TreasuryController::class, 'index']);
    Route::post('treasury/deposit', [TreasuryController::class, 'deposit']);
    Route::post('treasury/withdraw', [TreasuryController::class, 'withdraw']);
    
    // Installments
    Route::apiResource('installments', InstallmentController::class)->only(['index', 'store']);
    Route::post('installments/{installment}/collect', [InstallmentController::class, 'collect']);
    Route::get('installments/overdue', [InstallmentController::class, 'overdue']);
});
