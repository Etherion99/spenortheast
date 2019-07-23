<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;
use App\Member;

class ChaptersController extends Controller
{
    function create(Request $request){
        $newChapter = Chapter::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $imageResult = saveImage([
            'name' => $newChapter->id,
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
            'type' => $request->input('image_type')
        ]);

        Chapter::where('id', $request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

        return $imageResult;    
    }

    function remove(Request $request){
        $query = Chapter::select('extension')
            ->where('id', $request->input('id'))
            ->first();

        $extension = $query['extension'];

        $path = 'images/chapters/' . $request->input('id') . '.' . $extension;

        Storage::disk('public')->delete($path);

        Chapter::where('id', $request->input('id'))
            ->delete();

        return response()->json([
            'status' => 1,
            'message' => ''
        ]);
    }

    function description($id){
        $query = Chapter::select('description')
            ->where('id', $id)
            ->first();

        return response()->json($query);
    }
}
