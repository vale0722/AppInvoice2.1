<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('/user')->group( function() {
    Route::post('/login', 'Api\LoginController@login');
    Route::get('invoices', 'Api\InvoiceController@index');
    Route::post('invoices', 'Api\InvoiceController@store');
    Route::put('invoices/{invoice}', 'Api\InvoiceController@update');
    Route::delete('invoices/{invoice}', 'Api\InvoiceController@destroy');
    Route::get('invoices/{invoice}', 'Api\InvoiceController@show');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
