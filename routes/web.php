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

  Route::group(['prefix' => 'class'], function(){
    Route::get('list', ['uses' => 'ClassController@index', 'as' => 'class.list']);
    Route::post('big/create', ['uses' => 'ClassController@big_create', 'as' => 'class.big.create']);
    Route::post('small/create', ['uses' => 'ClassController@small_create', 'as' => 'class.small.create']);
    Route::post('small/delete', ['uses' => 'ClassController@small_delete', 'as' => 'class.small.delete']);
    Route::post('big/delete',  ['uses' => 'ClassController@big_delete', 'as' => 'class.big.delete']);
  });

  Route::group(['prefix' => 'shop'], function(){
    Route::get('list', ['uses' => 'ShopController@index', 'as' => 'shop.list']);
    Route::get('create', ['uses' => 'ShopController@create_index', 'as' => 'shop.create_index']);
    Route::get('update/{id}', ['uses' => 'ShopController@update_index', 'as' => 'shop.update_index']);
    Route::post('create', ['uses' => 'ShopController@create', 'as' => 'shop.create']);
    Route::post('delete', ['uses' => 'ShopController@delete', 'as' => 'shop.delete']);
    Route::post('update/{id}', ['uses' => 'ShopController@update', 'as' => 'shop.update']);
  });

  Route::group(['prefix' => 'member'], function() {
      Route::get('list', ['uses' => 'MemberController@member_list', 'as' => 'member.list']);
  });
});

Route::group(['prefix' => 'api', 'as' => 'api'], function(){
	Route::get('class/', ['uses' => 'ClassController@big_api', 'as' => 'api.class.big.list']);
	Route::get('class/{id}', ['uses' => 'ClassController@api', 'as' => 'api.class.list']);
	Route::get('class/{id}/list', ['uses' => 'ShopController@shop_list_api', 'as' => 'api.class.shop.list']);
	Route::get('shop/{id}', ['uses' => 'ShopController@shop_detail_api', 'as' => 'api.class.shop.detail']);
});