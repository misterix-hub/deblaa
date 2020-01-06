<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use App\Models\Universite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function checkEmailView() {
        return view('resets.checkEmailUniversite');
    }

    public function resetPasswordProcessing(Request $request) {
        $checkEmails = Universite::where('email', $request->email)->get();

        if (count($checkEmails) == 0 ) {
            return back()->with('error', 'Adresse électronique incorrecte');
        } else {

            $password = "DB".rand(1021, 9999);

            foreach($checkEmails as $checkEmail) {
                $sigle = session()->get('sigle', $checkEmail->sigle);
            }

            $to_name = "Deblaa";

            $to_email = $request->input('email');
            $data = array(
                'nom' => $sigle,
                'email' => $request->input('email'),
                'motDePasse' => $password
            );

            \Mail::send('mails.universite', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                    ->subject("Votre mot de passe de Deblaa");
            });

            DB::update('UPDATE universites SET password = ?, updated_at = ? WHERE email = ?', [
                bcrypt($password), now(), $request->input('email')
            ]);

            return redirect(route('uLogin'))->with('successReset', 'Un nouveau mot de passe a été envoyé dans votre boîte mail!');
        }
    }
}
