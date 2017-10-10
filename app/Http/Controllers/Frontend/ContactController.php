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
        $username = $req->name;
        $email = $req->email;
        $subject = $req->subject;
        $message = $req->message;
        $data = array(
          'username' => $username,
          'email' => $email,
          'subject' => $subject,
          'message' => $message,
        );
        Mail::send('front-end.email', $data, function($message) {
            $message->from('anhnt9@smartosc.com','Tuấn Anh');
            $message->subject('aaaa');
        });
        dd('Mail Send Successfully');
        echo "HTML Email Sent. Check your inbox.";
    }
}
