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
Route::get('/projects/{costumer}', 'CostumerController@projectsByCostumer')->name('costumers.projectsByCostumer');
Route::get('/project/{visit}', 'CostumerController@visitByCostumer')->name('costumers.visitByCostumer');
Route::get('/quote/{visit}', 'CostumerController@quote')->name('costumers.quote');
Route::get('/pdfquote/{visit}', 'CostumerController@generatePdf')->name('costumers.pdfquote');
Route::post('/addItems', 'ServiceController@storeItems')->name('service.storeItems');

Route::resources([
    'costumers' => 'CostumerController',
    'visits' => 'VisitController',
    'services' => 'ServiceController'
]);
});
