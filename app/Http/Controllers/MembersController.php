<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Member;
use App\Chapter;

class MembersController extends Controller
{
	function create(Request $request){
		$newMember = Member::create([
			'name' => $request->input('name'),
			'position' => $request->input('position'),
            'chapter' => $request->input('chapter') != 'null' ? $request->input('chapter') : null
		]);

		$imageResult = saveImage([
    		'name' => $newMember->id,
    		'image' => $request->file('image'),
    		'type' => $request->input('image_type')
    	]);
    	
    	return $imageResult;
	}

    function edit(Request $request){
    	$imageResult = saveImage([
    		'name' => $request->input('id'),
    		'image' => $request->file('image'),
    		'type' => $request->input('image_type')
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
