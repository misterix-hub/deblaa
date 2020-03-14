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

            if($request->password == '') {
               return back()->with('error', 'Mot de passe incorrect');
            }else{

                foreach ($structures_email as $structures_mail) {
                    $email = $structures_mail->email;
                    $password = $structures_mail->password;
                    $acces = $structures_mail->acces;
                }

                if (\Hash::check($request->password, $password)) {
                    if ($acces == "Banni") {
                        abort("401");
                    } else {

                        foreach ($structures_email as $structures_mail) {
                            session()->put('id', $structures_mail->id);
                            session()->put('logo', $structures_mail->logo);
                            session()->put('sigle', $structures_mail->sigle);
                            session()->put('email', $structures_mail->email);
                            session()->put('message_bonus', $structures_mail->message_bonus);
                            session()->put('pro', $structures_mail->pro);
                            session()->put('category', "structure");
                        }

                        return redirect(route('indexStructure'));
                    }

                } else {
                    return back()->with('error', "Mot de passe incorrect !");
                }
            }

        }
    }

    public function registerProcessing(Request $request) {

        $request->validate([
            'nom' => 'required|min:1|max:100',
            'sigle' => 'required|string|min:2|max:11',
            'email' => 'required'
        ],
            [
                'sigle.required' => 'Le champ du sigle est requis',
                'sigle.string' => 'Le sigle doit être une chaîne de caractères',
                'sigle.min' => 'Votre sigle est trop court',
                'sigle.max' => 'Le nombre de caractères maximal est atteint',
                'nom.required' => 'Le champ du nom est requis',
                'nom.min' => 'Votre nom est trop court',
                'nom.max' => 'Le nombre de caractères est atteint',
                'email.required' => 'le champ Email est requis',
        ]);

        $structures_email = Structure::where('email', $request->email)->get();

        if (count($structures_email) != 0) {
            return back()->with('error', "Email dejà utilisé !");
        } else {

            $password = "DB".rand(1021, 9999);

            $structure = new Structure;
            $structure->nom = $request->nom;
            $structure->sigle = $request->sigle;
            $structure->message_bonus = 3;
            $structure->email = $request->email;
            $structure->password = bcrypt($password);
            $structure->acces = 1;
            $structure->pro = 0;
            $structure->save();

            $to_name = "Deblaa";

            $to_email = $request->input('email');
            $data = array(
                'nom' => $request->input('sigle'),
                'email' => $request->input('email'),
                'motDePasse' => $password
            );

            \Mail::send('mails.structure', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                        ->subject("Votre mot de passe de Deblaa");
            });

            session()->put('email', $request->get('email'));

            return redirect(route('sRegisterSuccess'));
        }

    }

    public function registerSuccess() {
        if(!session()->has('email')) {
            abort('404');
        } else {
            return view('structure.success.register');
        }
    }

    public function logout() {
        session()->forget('id');
        session()->forget('logo');
        session()->forget('category');
        session()->forget('message_bonus');

        return redirect(route('indexVisitors'));
    }

}
