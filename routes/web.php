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
Route::get('/invoices/{id}/confirmDelete', 'InvoiceController@confirmDelete');
Route::get('/clients/{id}/confirmDelete', 'ClientsController@confirmDelete');
Route::get('/invoicesItems/{id}/view', 'InvoiceController@view');
Route::get('/invoices/{invoice}/invoiceItems/create', 'InvoiceItemController@create');
Route::post('/invoices/{invoice}/invoiceItems', 'InvoiceItemController@store');