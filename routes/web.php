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

Route::get('/customer/{customer}/visits', 'VisitController@visitsByCustomer')->name('visits.visitsByCustomer');
Route::get('/visit/{visit}', 'VisitController@details')->name('visits.details');
Route::get('/service/visit/{visit}', 'ServiceController@servicesByVisit')->name('services.servicesByVisit');
Route::get('/pdf/proposal/{service}', 'PdfController@generateProposal')->name('pdf.proposal');
Route::get('/pdf/quote/{service}/{visit}/{type}', 'PdfController@generateQuote')->name('pdf.quote');
Route::get('pdf/project_page/{service}','pdfController@generateFrontpage')->name('pdf.front');
Route::post('/create/quotes', 'QuoteController@store')->name('quotes.store');
Route::put('/update/{service}', 'QuoteController@update')->name('quotes.update');
Route::put('/update/{visit}', 'VisitController@update')->name('visits.update');
Route::put('/edit/{visit}', 'VisitController@edit')->name('visits.edit');
Route::put('/edit/{customer}', 'CustomerController@edit')->name('customers.edit');
Route::get('/create/quote/{visit}', 'ServiceController@createQuote')->name('services.createQuote');
Route::get('/edit/quote/{visit}/{service}', 'ServiceController@editQuote')->name('services.editQuote');
Route::get('/duplicate/service/{service}', 'ServiceController@duplicateQuote')->name('services.duplicateQuote');



Route::resources([
    'customers' => 'CustomerController',
    'visits' => 'VisitController',
    'services' => 'ServiceController',
    'notes' => 'NoteController',
    'items' => 'ItemController',
    'suppliers' => 'SupplierController'
]);
});
