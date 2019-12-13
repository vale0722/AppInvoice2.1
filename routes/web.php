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
Route::get('/invoices/{id}/confirmDelete', 'InvoiceController@confirmDelete');
Route::get('/clients/{id}/confirmDelete', 'ClientsController@confirmDelete');
Route::get('/products/{id}/confirmDelete', 'ProductController@confirmDelete');
Route::get('/companies/{id}/confirmDelete', 'CompanyController@confirmDelete');
Route::get('/invoicesItems/{id}/view', 'InvoiceController@view');
Route::get('/invoices/{id}/invoice_product/create', 'InvoiceController@createInvoiceProduct');
Route::post('/invoices/{id}/invoice_product', 'InvoiceController@invoiceProductStore');
Route::get('/invoices/create', 'InvoiceController@create');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

?>