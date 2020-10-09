<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ttt', [App\Http\Controllers\HomeController::class, 'x'])->name('home');
/*** client client   * */

Route::apiResource('client', App\Http\Controllers\ClientController::class);

Route::post('/postclient',[App\Http\Controllers\ClientController::class, 'store']);

Route::get('/getclient',[App\Http\Controllers\ClientController::class, 'get_client']);

Route::put('/updateclient',[App\Http\Controllers\ClientController::class, 'update']);

Route::delete('/deleteclient/{id}',[App\Http\Controllers\ClientController::class, 'destroy']);


/*** Model product  * */


Route::resource('product', App\Http\Controllers\ProductController::class);
Route::get('/getproduct',[App\Http\Controllers\ProductController::class, 'get_product']);
Route::post('/product/store',[App\Http\Controllers\ProductController::class, 'store']);
Route::post('/product/store_img',[App\Http\Controllers\ProductController::class, 'stote_img']);
Route::delete('/product/remove_img/{id}',[App\Http\Controllers\ProductController::class, 'dropzoneRemove']);
Route::delete('/deleteproduct/{id}',[App\Http\Controllers\ProductController::class, 'destroy']);
Route::post('/updateproduct',[App\Http\Controllers\ProductController::class, 'update']);

Route::get('/getproduct',[App\Http\Controllers\ProductController::class, 'get_product']);

Route::post('/getproduct_data',[App\Http\Controllers\ProductController::class, 'get_data_product']);

Route::get('/search_product',[App\Http\Controllers\ProductController::class, 'search_product']);

/*** Model gategorie   * */

Route::resource('gategorie', App\Http\Controllers\GategorieController::class);

Route::post('/postgategorie',[App\Http\Controllers\GategorieController::class, 'store']);

Route::get('/getgategorie',[App\Http\Controllers\GategorieController::class, 'get_gategorie']);

Route::put('/updategategorie',[App\Http\Controllers\GategorieController::class, 'update']);

Route::delete('/deletegategorie/{id}',[App\Http\Controllers\GategorieController::class, 'destroy']);


/*** Model marque   * */

Route::resource('marque', App\Http\Controllers\MarqueController::class);

Route::post('/postmarque',[App\Http\Controllers\MarqueController::class, 'store']);

Route::get('/getmarque',[App\Http\Controllers\MarqueController::class, 'get_marque']);

Route::put('/updatemarque',[App\Http\Controllers\MarqueController::class, 'update']);

Route::delete('/deletemarque/{id}',[App\Http\Controllers\MarqueController::class, 'destroy']);

/*** Model order   * */

Route::resource('order', App\Http\Controllers\OrderController::class);
Route::post('/getphone',[App\Http\Controllers\OrderController::class, 'get_phone_client']);
Route::get('/getorder',[App\Http\Controllers\OrderController::class, 'getorder']);
Route::delete('/deleteproduct/{id}',[App\Http\Controllers\OrderController::class, 'destroy']);



Auth::routes();


