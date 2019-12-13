<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {
        $etudiant_telephones = User::where('telephone', $request->telephone)->get();

        if (count($etudiant_telephones) == 0) {
            return back()->with('error', "Numéro de téléphone incorrecte !");
        } else {
            foreach ($etudiant_telephones as $etudiant_telephone) {
                $telephone = $etudiant_telephone->telephone;
                $password = $etudiant_telephone->password;
                session()->put('id', $etudiant_telephone->id);
                session()->put('nom_complet', $etudiant_telephone->name);
                session()->put('filiere_id', $etudiant_telephone->filiere_id);
                session()->put('niveau_id', $etudiant_telephone->niveau_id);
            }

            if (\Hash::check($request->password, $password)) {
                return redirect(route('inboxEtudiant'));
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }   
    }
}
