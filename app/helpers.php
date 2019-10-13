<?php 

use Vinkla\Instagram\Instagram;
use App\Image;
use App\Member;
use App\Event;
use App\Chapter;
use App\Program;

function saveImage($data){
	$tables = [
		'members' => new Member,
		'events' => new Event,
		'chapters' => new Chapter,
		'programs' => new Program
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

function getIGFeed(){
    $instagram = new Instagram('11388896573.151c37b.c0490b15540b4c2daf3bea15e991cc34');
    $media = $instagram->media(['count' => 4]);

    $pubs = [];
    
    foreach ($media as $pub) {
    	$captionParts = explode(' ', $pub->caption->text);
    	$caption = '';
    	$characters = 0;

    	foreach ($captionParts as $captionPart) {
    		$characters += strlen($captionPart.' ');

    		if($characters > 218){
    			$caption .= '...';
    			break;
    		}

    		if(substr($captionPart, 0, 1) == '@'){
    			$caption .= "<a href='https://www.instagram.com/".substr($captionPart, 1, strlen($captionPart) - 1)."'>".$captionPart."</a> ";
    		}else if(substr($captionPart, 0, 1) == '#'){
    			$caption .= "<a href='https://www.instagram.com/explore/tags/".substr($captionPart, 1, strlen($captionPart) - 1)."'>".$captionPart."</a> ";
    		}else{
    			$caption .= $captionPart.' ';
    		}   		
    	}

        array_push($pubs, (object) array(
            'image' => $pub->images->standard_resolution->url,
            'caption' => $caption,
        ));
    }

    return $pubs;
}