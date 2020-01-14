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
                $acces = $universites_mail->acces;
            }

            if($request->password == '') {
                return back()->with('error', 'Mot de passe incorrect');
            }else {
                if (\Hash::check($request->password, $password)) {
                    if ($acces == "Banni") {
                        abort("401");
                    } else {
                        foreach ($universites_email as $universites_mail) {
                            session()->put('id', $universites_mail->id);
                            session()->put('logo', $universites_mail->logo);
                            session()->put('sigle', $universites_mail->sigle);
                            session()->put('pro', $universites_mail->pro);
                            session()->put('message_bonus', $universites_mail->message_bonus);
                            session()->put('category', "universite");
                        }
                        return redirect(route('indexUniversite'));
                    }

                } else {
                    return back()->with('error', "Mot de passe incorrect !");
                }
            }

        }   
    }

    public function registerProcessing(Request $request) {

        $universites_email = Universite::where('email', $request->email)->get();

        if (count($universites_email) != 0) {
            return back()->with('error', "Email dejà utilisé !");
        } else {

            $password = "DB".rand(1021, 9999);

            $universite = new Universite;
            $universite->nom = $request->nom;
            $universite->sigle = $request->sigle;
            $universite->message_bonus = 0;
            $universite->email = $request->email;
            $universite->password = bcrypt($password);
            $universite->acces = 1;
            $universite->pro = 0;
            $universite->save();

            $to_name = "Deblaa";

            $to_email = $request->input('email');
            $data = array(
                'nom' => $request->input('sigle'),
                'email' => $request->input('email'),
                'motDePasse' => $password
            );

            \Mail::send('mails.universite', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                        ->subject("Votre mot de passe de Deblaa");
            });

            session()->put('email', $request->email);
            
            return redirect(route('uRegisterSuccess'));
        }

    }

    public function registerSuccess() {
        if(!session()->has('email')) {
            abort('404');
        } else {
            return view('universite.success.register');
        }
    }
    
    public function logout() {
        session()->forget('id');
        session()->forget('logo');
        session()->forget('sigle');
        session()->forget('category');
        session()->forget('message_bonus');

        return redirect(route('indexVisitors'));
    }
}
