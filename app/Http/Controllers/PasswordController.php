<?php

namespace App\Http\Controllers;

use App\Mail\ResetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function forget(){
        
    }

    public function sendMail(Request $request){
        // $request->validate([
        //     'email' => 'required',
        // ]);
        $token = bin2hex(random_bytes(32));

        $data = [
            'link' => url("/reset?token=$token"),
        ];

        Mail::to('wwwnuriscs76@gmail.com')->send(new ResetEmail($data));
        return 'Email berhasil dikirim';
    }
}
