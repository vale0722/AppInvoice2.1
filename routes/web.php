<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::resource('/invoices', 'InvoiceController');
Route::resource('/clients', 'ClientsController');
Route::resource('/products', 'Product_Controller');
Route::get('/invoices/{id}/confirmDelete', 'InvoiceController@confirmDelete');
Route::get('/clients/{id}/confirmDelete', 'ClientsController@confirmDelete');
Route::get('/products/{id}/confirmDelete', 'Product_Controller@confirmDelete');
Route::get('/invoicesItems/{id}/view', 'InvoiceController@view');
Route::get('/invoices/{id}/invoice_product/create', 'InvoiceController@createInvoice_product');
Route::post('/invoices/{id}/invoice_product', 'InvoiceController@Invoice_productStore');
Route::get('/invoices/create', 'InvoiceController@create');
