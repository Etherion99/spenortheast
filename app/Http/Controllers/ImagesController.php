<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Image;

class ImagesController extends Controller
{
    function upload(Request $request){
    	return saveImage([
    		'name' => $request->input('name'),
    		'image' => $request->file('image'),
    		'type' => $request->input('type'),
    		'operation' => 'update'
    	]);
    }
}
