<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendMailController extends Controller
{

    public function sendMail(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'user_name' => $request->input('user_name'),
            'password' => rand(100000, 999999)
        ];

        Mail::to(getenv('MAIL_USERNAME'))->send(new SendMail($data));

        if (Mail::failures()) {
            return redirect()->route('contact-page')->with('error', 'Gửi email thất bại.');
        }
        return redirect()->route('contact-page')->with('success', 'The email has been successfully sent to the system');
    }
}
