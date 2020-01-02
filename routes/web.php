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
Route::get('/index', 'HomeController@index1');
Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::resource('/invoices', 'InvoiceController');
Route::resource('/clients', 'ClientsController');
Route::resource('/products', 'ProductController');
Route::resource('/companies', 'CompanyController');
Route::get('/invoices/{id}/confirmDelete', 'InvoiceController@confirmDelete')->name('invoices.confirm.delete');
Route::get('/clients/{id}/confirmDelete', 'ClientsController@confirmDelete')->name('clients.confirm.delete');
Route::get('/products/{id}/confirmDelete', 'ProductController@confirmDelete')->name('products.confirm.delete');
Route::get('/companies/{id}/confirmDelete', 'CompanyController@confirmDelete')->name('companies.confirm.delete');
Route::get('/invoicesItems/{id}/view', 'InvoiceController@view');
Route::get('/invoices/{id}/invoice_product/create', 'InvoiceController@createInvoiceProduct');
Route::post('/invoices/{id}/invoice_product', 'InvoiceController@invoiceProductStore');
Route::get('/invoices/create', 'InvoiceController@create');
Route::get('/invoices/import/view', 'InvoiceController@indexImport')->name('invoices.import.view');
Route::post('/invoices/import', 'InvoiceController@importExcel')->name('invoices.import');
Route::get('/exportInvoices', 'InvoiceController@exportExcel')->name('invoices.export');
Route::get('/clients/import/view', 'ClientsController@indexImport')->name('clients.import.view');
Route::post('/clients/import', 'ClientsController@importExcel')->name('clients.import');
Route::get('/exportClient', 'ClientsController@exportExcel')->name('clients.export');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
