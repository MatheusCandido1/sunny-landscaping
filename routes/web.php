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

Route::middleware('auth')->group( function () {

// PDFs Routes
Route::get('pdf/proposal/{service}', 'PdfController@generateProposal')->name('pdf.proposal');
Route::get('pdf/quote/{service}/{visit}/{type}', 'PdfController@generateQuote')->name('pdf.quote');
Route::get('pdf/project_page/{service}','PdfController@generateFrontpage')->name('pdf.front');
Route::get('pdf/waiver/{visit}','PdfController@generateWaiver')->name('pdf.waiver');
Route::get('pdf/estimate/{visit}','PdfController@generateEstimate')->name('pdf.estimate');
Route::get('pdf/contract/{visit}','PdfController@generateContract')->name('pdf.contract');
Route::get('pdf/nevadacontract/{visit}','PdfController@generateNevadaContract')->name('pdf.nevadacontract');
Route::get('pdf/changeorder/{changeorder}/visit/{visit}','PdfController@generateChangeOrder')->name('pdf.change');
Route::Get('pdf/full_proposal/{service}','PdfController@generateFullProposal')->name('pdf.full');

// Dashboard Routes
Route::get('dashboard/projects/status','HomeController@projectsByStatus')->name('dashboard.status');
Route::get('/home', 'HomeController@index')->name('home');

// Services Routes
Route::put('approve/status/{service}/{visit}','ServiceController@approve')->name('services.approve');
Route::put('disapprove/status/{service}/{visit}','ServiceController@disapprove')->name('services.disapprove');
Route::put('waiting/status/{service}/{visit}','ServiceController@waiting')->name('services.waiting');
Route::get('create/quote/{visit}/customer/{customer}', 'ServiceController@createQuote')->name('services.createQuote');
Route::get('edit/quote/visit/{visit}/service/{service}/customer/{customer}', 'ServiceController@editQuote')->name('services.editQuote');
Route::get('duplicate/service/{service}', 'ServiceController@duplicateQuote')->name('services.duplicateQuote');
Route::get('service/visit/{visit}/customer/{customer}', 'ServiceController@servicesByVisit')->name('services.servicesByVisit');


// Quotes Routes
Route::post('create/quote', 'QuoteController@store')->name('quotes.store');
Route::put('update/quote/{service}', 'QuoteController@update')->name('quotes.update');

// Visits Routes
Route::put('update/{visit}', 'VisitController@update')->name('visits.update');
Route::put('update/information/{visit}', 'VisitController@updateInformation')->name('visits.updateInformation');
Route::put('edit/{visit}', 'VisitController@edit')->name('visits.edit');
Route::put('visit/{visit}/status/{status}', 'VisitController@updateStatus')->name('visits.updateStatus');
Route::get('customer/{customer}/visits', 'VisitController@visitsByCustomer')->name('visits.visitsByCustomer');
Route::get('visit/{visit}', 'VisitController@details')->name('visits.details');

// Customers Routes
Route::put('edit/{customer}', 'CustomerController@edit')->name('customers.edit');

// Change Orders Routes
Route::get('changeorder/visit/{visit}/customer/{customer}', 'ChangeOrderController@changeOrderByVisit')->name('changeorders.changes');
Route::get('create/changeorder/visit/{visit}/customer{customer}', 'ChangeOrderController@createChangeOrder')->name('changeorders.createChange');

// Resources Routes
Route::resources([
    'customers' => 'CustomerController',
    'visits' => 'VisitController',
    'services' => 'ServiceController',
    'notes' => 'NoteController',
    'items' => 'ItemController',
    'suppliers' => 'SupplierController',
    'cities' => 'CityController',
    'sellers' => 'SellerController',
    'referrals' => 'ReferralController',
    'types' => 'TypeController',
    'users' => 'UserController',
    'changeorders' => 'ChangeOrderController'
]);
});
