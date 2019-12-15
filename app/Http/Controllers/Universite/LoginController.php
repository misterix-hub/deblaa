<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Universite;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {

        $universites_email = Universite::where('email', $request->email)->get();

        if (count($universites_email) == 0) {
            return back()->with('error', "Adresse email incorrecte !");
        } else {
            foreach ($universites_email as $universites_mail) {
                $email = $universites_mail->email;
                $password = $universites_mail->password;
                session()->put('id', $universites_mail->id);
                session()->put('logo', $universites_mail->logo);
                session()->put('sigle', $universites_mail->sigle);
                $acces = $universites_mail->acces;
            }

            if (\Hash::check($request->password, $password)) {
                if ($acces == "Banni") {
                    abort("401");
                } else {
                    return redirect(route('indexUniversite'));
                }
                
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }   
    }

    public function logout() {
        session()->forget('id');
        session()->forget('logo');

        return redirect(route('indexVisitors'));
    }
}
