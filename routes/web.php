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


/*** client client   * */

Route::apiResource('client', App\Http\Controllers\ClientController::class);

Route::post('/postclient',[App\Http\Controllers\ClientController::class, 'store']);

Route::get('/getclient',[App\Http\Controllers\ClientController::class, 'get_client']);

Route::put('/updateclient',[App\Http\Controllers\ClientController::class, 'update']);

Route::delete('/deleteclient/{id}',[App\Http\Controllers\ClientController::class, 'destroy']);



Route::prefix('product')->group(function () {
  

    /*** Model product  * */

Route::resource('/', App\Http\Controllers\ProductController::class);
Route::get('/getproduct',[App\Http\Controllers\ProductController::class, 'get_product']);
Route::get('/{id}/edit',[App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/store',[App\Http\Controllers\ProductController::class, 'store']);
Route::post('/store_img',[App\Http\Controllers\ProductController::class, 'stote_img']);
Route::delete('/remove_img/{id}',[App\Http\Controllers\ProductController::class, 'dropzoneRemove']);
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


/*** Model Modeles  * */


Route::resource('modele', App\Http\Controllers\ModeleController::class);

Route::post('/postmodele',[App\Http\Controllers\ModeleController::class, 'store']);

Route::get('/getmodele',[App\Http\Controllers\ModeleController::class, 'get_modele']);

Route::put('/updatemodele',[App\Http\Controllers\ModeleController::class, 'update']);

Route::delete('/deletemodele/{id}',[App\Http\Controllers\ModeleController::class, 'destroy']);


});








/*** Model order   * */

Route::resource('order', App\Http\Controllers\OrderController::class);
Route::post('/getphone',[App\Http\Controllers\OrderController::class, 'get_phone_client']);
Route::get('/getorder',[App\Http\Controllers\OrderController::class, 'getorder']);
Route::get('/create_order_s',[App\Http\Controllers\OrderController::class, 'create_superviseur']);
Route::post('/validation_commande',[App\Http\Controllers\OrderController::class, 'validation_commande']);
Route::post('update_order', [App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/deleteproduct/{id}',[App\Http\Controllers\OrderController::class, 'destroy']);


/*** Model utilisateurs permission  * */

Route::post('/permission_assigner', [App\Http\Controllers\PermissionsController::class, 'assignPermissions']);

Route::get('permission', [App\Http\Controllers\UserController::class, 'permissions'])->name('permission');

Route::get('users', [App\Http\Controllers\UserController::class, 'users'])->name('users');

Route::get('get_users', [App\Http\Controllers\UserController::class, 'get_users']);



Route::post('user_post', [App\Http\Controllers\UserController::class, 'create_user']);

Route::delete('/delete_user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit']);

Route::get('/user/{id}/edit_owner', [App\Http\Controllers\UserController::class, 'edit_owner'])->name('edit_owner');

Route::post('/update_user',[App\Http\Controllers\UserController::class, 'update']);


Route::get('permission_order', [App\Http\Controllers\UserController::class, 'permission_order'])->name('permission_order');


Route::get('permission', [App\Http\Controllers\UserController::class, 'permissions'])->name('permission');

/*** Model Role  * */

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::post('/postrole',[App\Http\Controllers\RoleController::class, 'store']);

Route::get('/getroles',[App\Http\Controllers\RoleController::class, 'get_roles']);

Route::put('/updaterole',[App\Http\Controllers\RoleController::class, 'update']);

Route::delete('/deleterole/{id}',[App\Http\Controllers\RoleController::class, 'destroy']);



/*** Model Folder  * */

Route::resource('folder', App\Http\Controllers\FolderController::class);

Route::post('/postrole',[App\Http\Controllers\FolderController::class, 'store']);

Route::get('/get_folders_items',[App\Http\Controllers\FolderController::class, 'get_folders_items']);

Route::put('/updaterole',[App\Http\Controllers\FolderController::class, 'update']);

Route::delete('/deleterole/{id}',[App\Http\Controllers\FolderController::class, 'destroy']);







Auth::routes();
