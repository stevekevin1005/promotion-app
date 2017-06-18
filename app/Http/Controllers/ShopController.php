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

}