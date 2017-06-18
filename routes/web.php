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

Route::get('/login', ['uses' => 'LoginController@index', 'as' => 'login']);
Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);
Route::post('/login', ['uses' => 'LoginController@indexCheck', 'as' => 'loginCheck']);

Route::group(['middleware' => 'auth.login'], function () {
  Route::get('/', function() {
      return redirect('class/list');
  });
  Route::get('/class/list', ['uses' => 'ClassController@index', 'as' => 'class.list']);
  Route::post('/class/create', ['uses' => 'ClassController@create', 'as' => 'class.create']);
  Route::post('/class/delete', ['uses' => 'ClassController@delete', 'as' => 'class.delete']);

  Route::get('/shop/list', ['uses' => 'ShopController@index', 'as' => 'shop.list']);
});

Route::group(['prefix' => 'api', 'as' => 'api'], function(){
	Route::get('class/', ['uses' => 'ClassController@big_api', 'as' => 'api.class.big.list']);
	Route::get('class/{id}', ['uses' => 'ClassController@api', 'as' => 'api.class.list']);
	Route::get('class/{id}/list', ['uses' => 'ShopController@shop_list_api', 'as' => 'api.class.shop.list']);
	Route::get('shop/{id}', ['uses' => 'ShopController@shop_detail_api', 'as' => 'api.class.shop.detail']);
});