<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MessagesController extends Controller
{
    function send(Request $request){
    	
    	$data = $request->all();
 
        Mail::send('mails.standard', $data, function($message) use($data) {
            $message->from($data['email'])
            	->to('juanstt99@gmail.com')
                ->subject($data['subject']);
        });
    	

		return response()->json([
			'status' => 1,
			'message' => ''
		]);
    }
}
