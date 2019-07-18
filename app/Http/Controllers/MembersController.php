<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Member;

class MembersController extends Controller
{
	function create(Request $request){
		$newMember = Member::create([
			'name' => $request->input('name'),
			'position' => $request->input('position')
		]);

		$imageResult = saveImage([
    		'name' => $newMember->id,
    		'image' => $request->file('image'),
    		'type' => $request->input('image_type'),
    		'operation' => 'create'
    	]);
    	
    	return $imageResult;
	}

    function edit(Request $request){
    	$imageResult = saveImage([
    		'name' => $request->input('id'),
    		'image' => $request->file('image'),
    		'type' => $request->input('image_type'),
    		'operation' => 'update'
    	]);

		Member::where('id', $request->input('id'))
			->update([
				'name' => $request->input('name'),
				'position' => $request->input('position')
			]);

    	return $imageResult; 	
    }

    function remove(Request $request){
    	$query = Member::select('extension')
    		->where('id', $request->input('id'))
    		->first();

    	$extension = $query['extension'];

    	$path = 'images/members/' . $request->input('id') . '.' . $extension;

    	Storage::disk('public')->delete($path);

    	Member::where('id', $request->input('id'))
    		->delete();

    	return response()->json([
			'status' => 1,
			'message' => ''
		]);
    }
}
