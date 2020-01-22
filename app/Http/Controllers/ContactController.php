<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessageByUser(Request $request) {

        $request->validate([
            'sigle' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $to_name = "AVIS de ".$request->input('sigle');

        $data = array(
            'sigle' => $request->input('sigle'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        );

        Mail::send("mails.users.message", $data, function ($message) use ($to_name) {
            $message->to("deblaa.ap@gmail.com")
                ->subject($to_name);
        });

        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
