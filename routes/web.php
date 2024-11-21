<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;


Route::controller(ProductController::class)->middleware('auth')->group(function() {
    Route::get('/', 'viewProductsList');
    Route::get('/products/add', 'viewProductAddPage');
    Route::post('/products/add', 'saveNewProduct');
    Route::get('/products/delete/{id}', 'deleteProductById');
    Route::get('/products/edit/{id}', 'viewEditProductPage');
    Route::post('/products/edit', 'updateProductInfo');

    // exporting routes
    Route::get('/export-products-as-pdf', 'exportProductsAsPdf');
    Route::get('/export-products-as-csv', 'exportProductsAsCSV');
    Route::get('/export-products-as-excel', 'exportProductsAsExcel');
});


Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'viewLoginPage')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::get('/logout', 'logout')->middleware('auth');
});