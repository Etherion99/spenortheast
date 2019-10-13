<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Program;

class ProgramsController extends Controller
{
    function create(Request $request){
        $newProgram = Program::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $imageResult = saveImage([
            'name' => $newProgram->id,
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

        Program::where('id', $request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

        return $imageResult;    
    }

    function remove(Request $request){
        $query = Program::select('extension')
            ->where('id', $request->input('id'))
            ->first();

        $extension = $query['extension'];

        $path = 'images/programs/' . $request->input('id') . '.' . $extension;

        Storage::disk('public')->delete($path);

        Program::where('id', $request->input('id'))
            ->delete();

        return response()->json([
            'status' => 1,
            'message' => ''
        ]);
    }

    function description($id){
        $query = Program::select('description')
            ->where('id', $id)
            ->first();

        return response()->json($query);
    }
}
