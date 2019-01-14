 <?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::resource('/customer','ApiCustomer',array(
	'except'=>array('create','edit')
	)
);

Route::resource('/supplier', 'ApiSupplier',array(
	'expect'=>array('create','edit')
	)
);

Route::resource('/warehouse','ApiWarehouse',array(
	'expect'=>array('create','edit')
	)

);

Route::resource('/employee','ApiEmployee',array(
	'expect'=>array('create','edit')	
	)
);

Route::resource('/sale','ApiSale',array(
	'expect'=>array('create','edit')	
	)
);
Route::resource('/category','ApiCategory',array(
	'expect'=>array('create','edit')	
	)
);

Route::resource('/purchase','ApiPurchase',array(
	'expect'=>array('create','edit')	
	)
);
Route::resource('/detail','ApiDetail',array(
	'expect'=>array('create','edit')	
	)
);