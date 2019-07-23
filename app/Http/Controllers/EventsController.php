<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;

class EventsController extends Controller
{
    function create(Request $request){
        $newEvent = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => Carbon::createFromFormat('d/m/Y H:i', $request->input('start_date'))->toDateTime(),
            'end_date' => Carbon::createFromFormat('d/m/Y H:i', $request->input('end_date'))->toDateTime()
        ]);

        $imageResult = saveImage([
            'name' => $newEvent->id,
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

        Event::where('id', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => Carbon::createFromFormat('d/m/Y H:i', $request->input('start_date'))->toDateTime(),
                'end_date' => Carbon::createFromFormat('d/m/Y H:i', $request->input('end_date'))->toDateTime()
            ]);

        return $imageResult;    
    }

    function remove(Request $request){
    	$query = Event::select('extension')
    		->where('id', $request->input('id'))
    		->first();

    	$extension = $query['extension'];

    	$path = 'images/events/' . $request->input('id') . '.' . $extension;

    	Storage::disk('public')->delete($path);

    	Event::where('id', $request->input('id'))
    		->delete();

    	return response()->json([
			'status' => 1,
			'message' => ''
		]);
    }

    function description($id){
        $query = Event::select('description')
            ->where('id', $id)
            ->first();

        return response()->json($query);
    }
}
