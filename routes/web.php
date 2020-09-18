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

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*** Model product  * */


Route::resource('product', 'ProductController');
Route::get('/getproduct','ProductController@get_product');
Route::delete('/deleteproduct/{id}','ProductController@destroy');

Route::get('/getproduct','ProductController@get_product');

Route::post('/getproduct_data','ProductController@get_data_product');


/*** Model gategorie   * */

Route::resource('gategorie', 'GategorieController');

Route::post('/postgategorie','GategorieController@store');

Route::get('/getgategorie','GategorieController@get_gategorie');

Route::put('/updategategorie','GategorieController@update');

Route::delete('/deletegategorie/{id}','GategorieController@destroy');

/*** Model marque   * */

Route::resource('marque', 'MarqueController');

Route::post('/postmarque','MarqueController@store');

Route::get('/getmarque','MarqueController@get_marque');

Route::put('/updatemarque','MarqueController@update');

Route::delete('/deletemarque/{id}','MarqueController@destroy');





/*** Model order   * */

Route::resource('order', 'OrderController');
Route::post('/getphone','OrderController@get_phone_client');
Route::get('/getorder','OrderController@getorder');
Route::delete('/deleteproduct/{id}','OrderController@destroy');



/*** client client   * */

Route::resource('client', 'ClientController');

Route::post('/postclient','ClientController@store');

Route::get('/getclient','ClientController@get_client');

Route::put('/updateclient','ClientController@update');

Route::delete('/deleteclient/{id}','ClientController@destroy');


        