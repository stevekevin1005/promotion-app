<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Hash;

class MemberController extends Controller
{
	public function member_list()
	{
		return view('member.list');
	}

	public function member_edit(Request $request)
	{
		try{
			$password = $request->password1;
			if($request->password1 != $request ->password2){
				return back()->withErrors(['msg'=>'兩次密碼不一致']);
			}
			$user = User::find(1);
			$user->password = Hash::make($request->password1);
			$user->save();
			return back();
		}
		catch(Exception $e){
			return back()->withErrors(['msg'=>'伺服器錯誤']);
		}
		catch(\Illuminate\Database\QueryException $e){
			return back()->withErrors(['msg'=>'資料庫錯誤']);
		}
	}
}