<?php 

use App\Image;
use App\Member;
use App\Event;

function saveImage($data){
	$tables = [
		'members' => new Member,
		'events' => new Event
	];

	$validation = Validator::make($data, [
      'image' => 'image|mimes:jpeg,png,jpg'
    ]);

	if($validation->passes()){
		if($data['type'] == 'main'){
			$path = 'images';

			Image::where('name', $data['name'])
				->update(['extension' => $data['image']->getClientOriginalExtension()]);
		}else{
			$path = 'images/'.$data['type'];

			$tables[$data['type']]->where('id', $data['name'])
				->update(['extension' => $data['image']->getClientOriginalExtension()]);
		}

		$new_name = $data['name'] . '.' . $data['image']->getClientOriginalExtension();
		$data['image']->move(public_path($path), $new_name);

		$status = 1;
		$message = '';
		$extension = $data['image']->getClientOriginalExtension();
	}else{
		$status = 0;
		$message = $validation->errors();
		$extension = '';
	}

	return response()->json([
		'status' => $status,
		'message' => $message,
		'extension' => $extension
	]);
}