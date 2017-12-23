<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class ContactController extends Controller
{
    public function getContact(){
        return view('front-end.contact');
    }

    public function postContact(Request $req){
        $data = array(
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'telephone' => $req->input('telephone'),
            'message' => $req->input('message'),
        );

        Mail::send('front-end.email', ['list' => $data], function($message) use ($data)
        {
            $message->from('chipstart1994@gmail.com', 'Send mail Contact');
            $message->to('thuhangitepu@gmail.com', 'Thu Hằng')->subject('Information custom web Fresh-Garden');
        });
        return redirect()->route('success');
    }
}
