<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;

class IndexController extends Controller
{
	public function index()
	{
		return view('welcome');
	}
}