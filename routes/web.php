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

//Clear route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// Clear application cache:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
 Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
 Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
 Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('auth')->group( function () {

// PDFs Routes
Route::get('pdf/quote/{service}/{visit}/{type}', 'PdfController@generateQuote')->name('pdf.quote');
Route::get('pdf/project_page/{service}','PdfController@generateFrontpage')->name('pdf.front');
Route::get('pdf/waiver/{visit}','PdfController@generateWaiver')->name('pdf.waiver');
Route::get('pdf/estimate/{visit}','PdfController@generateEstimate')->name('pdf.estimate');
Route::get('pdf/contract/{visit}','PdfController@generateContract')->name('pdf.contract');
Route::get('pdf/nevadacontract/{visit}','PdfController@generateNevadaContract')->name('pdf.nevadacontract');
Route::get('pdf/changeorder/{changeorder}/visit/{visit}','PdfController@generateChangeOrder')->name('pdf.change');
Route::get('pdf/full_proposal/{service}','PdfController@generateFullProposal')->name('pdf.full');


// Dashboard Routes
Route::get('dashboard/projects/status/{status}','HomeController@projectsByStatus')->name('dashboard.status');
Route::get('dashboard/visits/{status}', 'HomeController@visitsByStatus')->name('dashboard.visits');
Route::get('dashboard/total/status/{status}', 'HomeController@totalByStatus')->name('dashboard.total');
Route::get('dashboard/{start_date}/{end_date}/{status}', 'HomeController@optionsByStatus')->name('dashboard.options');
Route::get('dashboard/quotes','HomeController@quotes')->name('dashboard.quotes');
Route::get('/home', 'HomeController@index')->name('home');

// Dashboard Routes

Route::get('sum/status/{status}/{start_date}/{end_date}', 'CustomerSearchController@sumByStatusAndData')->name('json.sumStatys');

// Services Routes
Route::put('approve/status/{service}/{visit}','ServiceController@approve')->name('services.approve');
Route::put('disapprove/status/{service}/{visit}','ServiceController@disapprove')->name('services.disapprove');
Route::put('waiting/status/{service}/{visit}','ServiceController@waiting')->name('services.waiting');
Route::put('select/status/{service}/{visit}','ServiceController@select')->name('services.select');
Route::get('create/quote/{visit}/customer/{customer}', 'ServiceController@createQuote')->name('services.createQuote');
Route::get('edit/quote/visit/{visit}/service/{service}/customer/{customer}', 'ServiceController@editQuote')->name('services.editQuote');
Route::get('duplicate/service/{service}', 'ServiceController@duplicateQuote')->name('services.duplicateQuote');
Route::get('service/visit/{visit}/customer/{customer}', 'ServiceController@servicesByVisit')->name('services.servicesByVisit');


// Custom Search
Route::get('customsearch/services', 'CustomSearchController@index')->name('customsearch.index');
Route::get('customsearch/visits', 'CustomSearchController@visitsByStatus')->name('customsearch.visits');
Route::get('customsearch/total', 'CustomSearchController@sumByStatusAndData')->name('customsearch.total');


// Quotes Routes
Route::post('create/quote', 'QuoteController@store')->name('quotes.store');
Route::put('update/quote/{service}', 'QuoteController@update')->name('quotes.update');

// Visits Routes
Route::put('update/{visit}', 'VisitController@update')->name('visits.update');
Route::put('update/information/{visit}', 'VisitController@updateInformation')->name('visits.updateInformation');
Route::put('edit/{visit}', 'VisitController@edit')->name('visits.edit');
Route::put('visit/{visit}/status/{status}', 'VisitController@updateStatus')->name('visits.updateStatus');
Route::put('visit/{visit}/status', 'VisitController@updateStatusOnIndex')->name('visits.updateStatusIndex');
Route::get('customer/{customer}/visits', 'VisitController@visitsByCustomer')->name('visits.visitsByCustomer');
Route::get('visit/{visit}', 'VisitController@details')->name('visits.details');

// Customers Routes
Route::put('edit/{customer}', 'CustomerController@edit')->name('customers.edit');

// Change Orders Routes
Route::get('changeorder/visit/{visit}/customer/{customer}', 'ChangeOrderController@changeOrderByVisit')->name('changeorders.changes');
Route::get('create/changeorder/visit/{visit}/customer/{customer}', 'ChangeOrderController@createChangeOrder')->name('changeorders.createChange');
Route::get('changeorder/{changeorder}/visit/{visit}/customer/{customer}','ChangeOrderController@editChangeOrder')->name('changeorders.edit');
Route::put('update/{changeorder}','ChangeOrderController@updateChangeOrder')->name('changeorders.update');
Route::delete('changeorger/{changeorder}','ChangeOrderController@destroy')->name('changeorders.destroy');
Route::post('store/changeorder','ChangeOrderController@store')->name('changeorders.store');
// Resources Routes
Route::resources([
    'customers' => 'CustomerController',
    'visits' => 'VisitController',
    'services' => 'ServiceController',
    'notes' => 'NoteController',
    'items' => 'ItemController',
    'cities' => 'CityController',
    'sellers' => 'SellerController',
    'referrals' => 'ReferralController',
    'types' => 'TypeController',
    'users' => 'UserController',
    'informations' => 'InformationController'
]);
});
