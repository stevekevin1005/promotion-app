<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
	public function member_list()
	{
		return view('welcome');
	}
}