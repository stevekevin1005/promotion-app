<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '256M');
use Illuminate\Http\Request;
use Imageupload;

class ImageController extends Controller
{
	public function upload(Request $request)
	{
		try{
			if($request->hasFile('upload')) {
				$result = Imageupload::upload($request->file('upload'));
				$url = $result['dimensions']['size540x360']['filename'];
				return $request->root().'/'.$result['dimensions']['size540x360']['filedir'];
			}
		}
		catch(Exception $e){
			return "Server error";
		}
	}
}