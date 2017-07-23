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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/test', function(){
	$data=App\Supplier::all();
	return view('test',['data'=>$data]);
});
Route::get('/order-upload','CostController@upload');
Route::get('/display-order',function(){
	$tborders=App\Tborder::completed()->orderBy('buytime')->get();
	$count=App\TbOrder::completed()->count();
	$remarks_count=App\TbOrder::remarked()->count();
	$total_price=0.0;
	foreach($tborders as $o)
	{
		$total_price+=$o->price;
	}
	return view('display-order',['data'=>$tborders,'total_price'=>$total_price,'count'=>$count]);
});
Route::get('download-order','CostController@download');
Route::post('/order-analyze','CostController@analyze');
