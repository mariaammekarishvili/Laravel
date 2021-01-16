<?php

namespace App\Http\Controllers;

use App\Mail\PostApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create_mail(){
        return view('email.send_mail');
    }
    public function send(Request $request){
        $data = [
            "text" =>'your order shipped'
        ];

        Mail::to(request('mail'))->send(new PostApprovedMail($data));
        return redirect()->route('create_mail');
    }
}
