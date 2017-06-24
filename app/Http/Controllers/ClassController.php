<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopClass;
use App\Models\ShopClassBig;

class ClassController extends Controller
{
	public function api(Request $request, $id)
	{
		$class_list = array();
		$class_obj = new ShopClass;
		foreach ($class_obj->where('ShopClassBigid', $id)->get() as $index => $class) {
			$class_list[] = $class;
		}

		return response()->json($class_list);
	}

	public function big_api()
	{
		$obj['id'] = 0;
		$obj['name'] = "最新優惠";
		$obj['created_at'] = "0000-00-00 00:00:00";
		$obj['updated_at'] = "0000-00-00 00:00:00";

		$class_obj = new ShopClassBig;
		$class_list[] = $obj;

		foreach ($class_obj->all() as $index => $class) {
			$class_list[] = $class;
		}

		return response()->json($class_list);
	}

	public function index()
	{
		$class_big = ShopClassBig::all();
		$view_data['class_list'] = $class_big;

		$class_small = ShopClass::all();

		foreach ($class_small as $key => $class) {
			$view_data['class_small_list'][$class->ShopClassBigid][] = $class;
		}
		return view('class.list', $view_data);
	}

	public function big_create(Request $request)
	{
		try{
			$class = new ShopClassBig;
			$class->name = $request->name;
			$class->save();
			return redirect('/class/list');
		}
		catch(Exception $e){
			return redirect('/class/list')->withErrors(['msg'=>'新增失敗']);
		}
	}

	public function small_create(Request $request)
	{
		try{
			$class = new ShopClass;
			$class->name = $request->name;
			$class->ShopClassBigid = $request->id;
			$class->save();
			return redirect('/class/list');
		}
		catch(Exception $e){
			return redirect('/class/list')->withErrors(['msg'=>'新增失敗']);
		}
	}

	public function small_delete(Request $request)
	{
		try{
			$class = new ShopClass;
			$class = $class->where('id', $request->id)->first();
			$class->shops()->delete();
			$class->delete();
			return response()->json('刪除成功');
		}
		catch(Exception $e){
			return response()->json('刪除失敗 請洽系統管理商');
		}
	}

	public function big_delete(Request $request)
	{
		try{
			$class = new ShopClassBig;
			$class = $class->where('id', $request->id)->first();
			//shop
			$small_clss_list = $class->small_classes()->get();
			foreach ($small_clss_list as $small_clss) {
				$small_clss->shops()->delete();
			}
			//small class
			$class->small_classes()->delete();
			$class->delete();
			return response()->json('刪除成功');
		}
		catch(Exception $e){
			return response()->json('刪除失敗 請洽系統管理商');
		}
	}
}