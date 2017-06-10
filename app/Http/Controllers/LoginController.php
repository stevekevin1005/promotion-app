<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function indexCheck(Request $request)
	{
		$user = User::where('name', $request->name)->first();

		if (Hash::check($request->password, $user->password))
		{
		  $request->session()->put('name', $request->name);
		  return redirect()->route('index');
		}
		return redirect('/login')->withErrors(['fail'=>'Name or password is wrong!']);
	}

	public function logout(Request $request)
	{
		$request->session()->flush();
		return redirect('/login');
	}
}