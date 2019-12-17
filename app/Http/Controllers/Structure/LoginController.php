<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {

        $structures_email = Structure::where('email', $request->email)->get();

        if (count($structures_email) == 0) {
            return back()->with('error', "Adresse email incorrecte !");
        } else {
            foreach ($structures_email as $structures_mail) {
                $email = $structures_mail->email;
                $password = $structures_mail->password;
                session()->put('id', $structures_mail->id);
                session()->put('logo', $structures_mail->logo);
                session()->put('sigle', $structures_mail->sigle);
                session()->put('category', "structure");
                $acces = $structures_mail->acces;
            }

            if (\Hash::check($request->password, $password)) {
                if ($acces == "Banni") {
                    abort("401");
                } else {
                    return redirect(route('indexStructure'));
                }

            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }
    }

    public function logout() {
        session()->forget('id');
        session()->forget('logo');
        session()->forget('category');

        return redirect(route('indexVisitors'));
    }

}
