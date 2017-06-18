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
		$class = new ShopClass;
		$class = $class->paginate(5);
		
		return view('class.list', ['class_list' => $class]);
	}

	public function create(Request $request)
	{
		try{
			$class = new ShopClass;
			$class->name = $request->name;
			$class->save();
			return redirect('/class/list');
		}
		catch(Exception $e){
			return redirect('/class/list')->withErrors(['msg'=>'新增失敗']);
		}
	}

	public function delete(Request $request)
	{
		try{
			$class = new ShopClass;
			$class = $class->where('id', $request->id);
			$class->delete();

			return redirect('/class/list');
		}
		catch(Exception $e){
			return redirect('/class/list')->withErrors(['msg'=>'刪除失敗']);
		}
	}
}