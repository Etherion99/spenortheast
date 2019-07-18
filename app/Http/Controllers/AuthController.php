<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request){
    	$data = $request->all();
    	$data['password'] = Hash::make($data['password']);
    	
    	$user = User::where('username', $data['username'])->first();
		
		if ($user === null){
			User::create($data);
			echo json_encode(array("status" => 1));
		}else{
			echo json_encode(array("status" => 0));
		}
    }

    function login(Request $request){
    	$data = $request->all();
    	
    	$user = User::where('username', $data['username'])->first();
		
		if ($user === null){
			echo json_encode(array("status" => 0));
		}else{
			if(Hash::check($data['password'], $user->password)){
				echo json_encode(array("status" => 1));
			}else{
				echo json_encode(array("status" => 2));
			}
			
		}
    }
}
