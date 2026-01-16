<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopOwnerController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('shop-owners', ShopOwnerController::class);
Route::get('shop-owners-export-excel', [ShopOwnerController::class, 'exportExcel'])->name('shop-owners.export-excel');
Route::get('shop-owners-export-pdf', [ShopOwnerController::class, 'exportPdf'])->name('shop-owners.export-pdf');

Route::resource('customers', CustomerController::class);
Route::get('customers-export-excel', [CustomerController::class, 'exportExcel'])->name('customers.export-excel');
Route::get('customers-export-pdf', [CustomerController::class, 'exportPdf'])->name('customers.export-pdf');
