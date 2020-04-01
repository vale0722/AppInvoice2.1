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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index');

Auth::routes();

Route::resource('/invoices', 'InvoiceController');
Route::get('/invoices/create', 'InvoiceController@create');
Route::get('/update', 'InvoiceController@updateInvoices')->name('invoices.updates');
Route::get('/invoices/{id}/invoice_product/create', 'InvoiceController@createInvoiceProduct');
Route::post('/invoices/{id}/invoice_product', 'InvoiceController@invoiceProductStore')->name('invoices.product.store');
Route::get('/invoices/{invoice}/confirmDelete', 'InvoiceController@confirmDelete')->name('invoices.confirm.delete');
Route::get('/invoices/import/view', 'InvoiceController@indexImport')->name('invoices.import.view');
Route::post('/invoices/import', 'InvoiceController@importExcel')->name('invoices.import');
Route::get('/exportInvoices', 'InvoiceController@exportExcel')->name('invoices.export');
Route::get('/invoices/{invoice}/annuled', 'InvoiceController@annuled')->name('invoices.annuled');
Route::get('/invoices/{invoice}/removeAnnuled', 'InvoiceController@removeAnnuled')->name('invoices.remove.annuled');
Route::get('/invoices/{invoice}/confirmAnnuled', 'InvoiceController@confirmAnnuled')->name('invoices.confirm.annuled');

Route::resource('/clients', 'ClientsController');
Route::get('/clients/{id}/confirmDelete', 'ClientsController@confirmDelete')->name('clients.confirm.delete');
Route::get('/clients/import/view', 'ClientsController@indexImport')->name('clients.import.view');
Route::post('/clients/import', 'ClientsController@importExcel')->name('clients.import');
Route::get('/exportClient', 'ClientsController@exportExcel')->name('clients.export');


Route::resource('/products', 'ProductController');
Route::get('/products/{id}/confirmDelete', 'ProductController@confirmDelete')->name('products.confirm.delete');

Route::get('/payment/{invoice}', 'PaymentController@index')->name('payments.index');
Route::get('/payment/create/{invoice}', 'PaymentController@create')->name('payments.create');
Route::post('/payment/create/{invoice}', 'PaymentController@store')->name('payments.store');
Route::get('/payment/show/{payment}/', 'PaymentController@show')->name('payments.show');

Route::get('/report', 'ReportController@index')->name('report.index');
Route::get('/users/{user}/edit', 'Auth\RegisterController@edit')->name('users.edit');
Route::put('/users/{user}/update', 'Auth\RegisterController@update')->name('users.update');
Route::get('/report/export/{firstCreationDate}/{finalCreationDate}/{format}/{state}', 'ReportController@export')->name('report.export');
Route::get('/reports', 'ReportController@show')->name('report.show');
Route::get('/reports/{id}', 'ReportController@delete')->name('report.delete');

Route::resource('/users', 'UserController')->except(['edit', 'update']);
