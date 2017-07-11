<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '256M');
use Illuminate\Http\Request;
use App\Models\ShopClass;
use App\Models\ShopClassBig;
use App\Models\Shop;
use Imageupload;

class ShopController extends Controller
{
	public function index(Request $request)
	{
		$class = ShopClass::all();
		$big_class = ShopClassBig::all();

		$view_data['class_list'] = $class;
		$view_data['big_class_list'] = $big_class;

		$class_id = $request->class;

		$shops = new Shop;
		if(!is_null($class_id)){
			$shop_list = $shops->where('shop_class_id', $class_id)->paginate(6);
		}
		else{
			$shop_list = $shops->paginate(6);
		}
		
		$view_data['shop_list'] = $shop_list;

		return view('shop.list', $view_data);
	}

	public function create_index(Request $request)
	{
		$class = ShopClass::all();
		$big_class = ShopClassBig::all();

		$view_data['class_list'] = $class;
		$view_data['big_class_list'] = $big_class;
		
		return view('shop.create', $view_data);
	}

	public function update_index(Request $request, $id)
	{
		$class = ShopClass::all();
		$big_class = ShopClassBig::all();
		$shop = Shop::where('id', $id)->first();
		$view_data['shop'] = $shop;
		$view_data['class_list'] = $class;
		$view_data['big_class_list'] = $big_class;
		
		return view('shop.create', $view_data);
	}

	public function shop_list_api(Request $request, $id)
	{
		$shops = new Shop;
		$shop_list = $shops->where('shop_class_id', $id)->get();

		$result = array();
		foreach ($shop_list as $key => $shop) {
			$obj['id'] = $shop->id;
			$obj['name'] = $shop->name;
			$obj['photo'] = $shop->photo;
			$obj['description'] = $shop->name;
			$obj['price'] = $shop->price;
			$result[] = $obj;
		}

		return response()->json($result);
	}

	public function shop_detail_api(Request $request, $id)
	{
		$shops = new Shop;
		$shop_detail = $shops->where('id', $id)->first();

		$result['id'] = $shop_detail->id;
		$result['name'] = $shop_detail->name;
		$result['photo'] = json_decode($shop_detail->cover_photo);
		$result['location'] = $shop_detail->location;
		$result['content'] = $shop_detail->content;
		$result['phone'] = $shop_detail->phone;
		$result['price'] = $shop_detail->price;
		$result['lat'] = $shop_detail->lat;
		$result['lng'] = $shop_detail->lng;
		$result['remark'] = $shop_detail->remark;

		return response()->json($result);
	}

	public function create(Request $request)
	{
		try{
			$Shop = new Shop;
			if ($request->hasFile('photo')) {
			  $result = Imageupload::upload($request->file('photo'));
			  $Shop->photo = $result['dimensions']['size540x360']['filename'];
			}
			$cover_photo_array = array();
			if ($request->hasFile('cover_photo')) {
			  foreach ($request->file('cover_photo') as $cover_photo) {
			  	$result = Imageupload::upload($cover_photo);
			  	$cover_photo_array[] = $result['dimensions']['size540x360']['filename'];
			  }
			  $Shop->cover_photo = json_encode($cover_photo_array);
			}
			$Shop->name = $request->input('name');
			$Shop->description = $request->input('description');
			$Shop->price = $request->input('price');
			$Shop->location = $request->input('location');
			$Shop->lat = $request->input('lat');
			$Shop->lng = $request->input('lng');
			$Shop->content = $request->input('content');
			$Shop->phone = $request->input('phone');
			$Shop->remark = $request->input('remark');
			$Shop->shop_class_big_id = $request->input('shop_class_big_id');
			$Shop->shop_class_id = $request->input('shop_class_id');
			$Shop->save();
			return redirect('/shop/list');
		}
		catch(Exception $e){
			return redirect('/shop/list')->withErrors(['msg'=>'新增失敗']);
		}
	}

	public function delete(Request $request)
	{
		try{
			$Shop = new Shop;
			$Shop = $Shop->where('id', $request->id)->first();
			$Shop->delete();
			return response()->json('刪除成功');
		}
		catch(Exception $e){
			return response()->json('刪除失敗 請洽系統管理商');
		}
	}

	public function update(Request $request, $id)
	{
		try{
			$Shop = Shop::where('id', $id)->first();
			if ($request->hasFile('photo')) {
			  $result = Imageupload::upload($request->file('photo'));
			  $Shop->photo = $result['dimensions']['size540x360']['filename'];
			}
			
			if ($request->hasFile('cover_photo')) {
			  $cover_photo_array = json_decode($Shop->cover_photo);
			  foreach ($request->file('cover_photo') as $index => $cover_photo) {
			  	$result = Imageupload::upload($cover_photo);
			  	$cover_photo_array[$index] = $result['dimensions']['size540x360']['filename'];
			  }
			  $Shop->cover_photo = json_encode($cover_photo_array);
			}
			$Shop->name = $request->input('name');
			$Shop->description = $request->input('description');
			$Shop->price = $request->input('price');
			$Shop->location = $request->input('location');
			$Shop->lat = $request->input('lat');
			$Shop->lng = $request->input('lng');
			$Shop->content = $request->input('content');
			$Shop->phone = $request->input('phone');
			$Shop->remark = $request->input('remark');
			$Shop->shop_class_big_id = $request->input('shop_class_big_id');
			$Shop->shop_class_id = $request->input('shop_class_id');
			$Shop->save();
			return redirect('/shop/list');
		}
		catch(Exception $e){
			return redirect('/shop/list')->withErrors(['msg'=>'更改失敗']);
		}
		return dd($request);
	}
}