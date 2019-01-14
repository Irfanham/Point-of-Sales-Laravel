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

/*
//to register a route that responds to multiple HTTP verbs
Route::match(['get','post'],'/coba', function () {
    return 'Uji Coba Laravel';
});

// to register a route that responds to all HTTP verbs
Route::any('coba-lagi', function () {
    return 'Uji Coba Laravel v2';
});

//to capture segments of the URI within
Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});*/
Auth::routes();

Auth::routes();

// Route::resource('pos','PosDataController');
// Route::resource('customer','CustomerController');
// Route::resource('purchase','PurchaseController');
// Route::resource('supplier','SupplierController');
// Route::resource('warehouse','WarehouseController');
// Route::resource('adduser','AddController');

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/customer', function () {
    return view('admin.customer');
});
Route::get('/sale', function () {
    return view('admin.sale');
});
Route::get('/supplier', function () {
    return view('admin.supplier');
});
Route::get('/adduser', function () {
    return view('admin.adduser');
});

// Route::get('/warehouse', function () {
//     return view('admin.warehouse');
// });
Route::get('/warehouse', function () {

    $warehouse = DB::table('warehouses')->get();

    return view('admin.warehouse', ['warehouse' => $warehouse]);
});
Route::get('/purchase', function () {
    return view('admin.purchase');
});
});
