<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopClass;
use App\Models\Shop;

class ShopController extends Controller
{
	public function index(Request $request)
	{
		$class = new ShopClass;
		$class = $class->all();
		$view_data['class_list'] = $class;

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
		$result['photo'] = explode(",", $shop_detail->cover_photo);
		$result['location'] = $shop_detail->location;
		$result['content'] = $shop_detail->content;
		$result['phone'] = $shop_detail->phone;
		$result['remark'] = $shop_detail->remark;

		return response()->json($result);
	}

}