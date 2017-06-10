<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopClass;

class ClassController extends Controller
{
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