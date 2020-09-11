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

Route::resource('product', 'ProductController');

Route::resource('gategorie', 'GategorieController');

Route::post('/postgategorie','GategorieController@store');

/*** Model gategorie   * */

Route::get('/getgategorie','GategorieController@get_gategorie');

Route::put('/updategategorie','GategorieController@update');

Route::delete('/deletegategorie/{id}','GategorieController@destroy');


        