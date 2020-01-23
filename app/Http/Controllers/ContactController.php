<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessageByUser(Request $request) {

        $data = request()->validate([
            'sigle' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::to("deblaa.ap@gmail.com")->send(new ContactFormMail($data));

        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
