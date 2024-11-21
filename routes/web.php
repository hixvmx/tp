<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::controller(ProductController::class)->group(function() {
    Route::get('/', 'viewProductsList');
    Route::get('/products/add', 'viewProductAddPage');
    Route::post('/products/add', 'saveNewProduct');

    // exporting routes
    Route::get('/export-products-as-pdf', 'exportProductsAsPdf');
    Route::get('/export-products-as-csv', 'exportProductsAsCSV');
    Route::get('/export-products-as-excel', 'exportProductsAsExcel');
});