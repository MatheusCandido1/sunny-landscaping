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
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group( function () {

Route::get('/visits/{customer}', 'VisitController@visitsByCustomer')->name('visits.visitsByCustomer');

Route::get('/quote/{visit}', 'CustomerController@quote')->name('customers.quote');
Route::get('/pdf/proposal/{visit}', 'PdfController@generateProposal')->name('pdf.proposal');
Route::get('/pdf/quote/{service}/{visit}/{type}', 'PdfController@generateQuote')->name('pdf.quote');
Route::post('/create/quotes', 'QuoteController@store')->name('quotes.store');
Route::get('/visit/{visit}/service/{service}', 'QuoteController@edit')->name('quotes.edit');
Route::put('/update/{service}', 'QuoteController@update')->name('quotes.update');
Route::put('/update/{visit}', 'VisitController@update')->name('visits.update');
Route::put('/edit/{visit}', 'VisitController@edit')->name('visits.edit');
Route::put('/edit/{customer}', 'CustomerController@edit')->name('customers.edit');


Route::resources([
    'customers' => 'CustomerController',
    'visits' => 'VisitController',
    'services' => 'ServiceController',
    'notes' => 'NoteController',
    'items' => 'ItemController',
    'suppliers' => 'SupplierController'
]);
});
