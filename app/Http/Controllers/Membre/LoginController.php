<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {
        $membre_telephones = User::where('telephone', $request->telephone)->get();

        if (count($membre_telephones) == 0) {
            return back()->with('error', "Numéro de téléphone incorrecte !");
        } else {
            foreach ($membre_telephones as $membre_telephone) {
                $telephone = $membre_telephone->telephone;
                $password = $membre_telephone->password;
                session()->put('id', $membre_telephone->id);
                session()->put('nom_complet', $membre_telephone->name);
                session()->put('departement_id', $membre_telephone->departement_id);
                session()->put('category', "membre");
            }

            if (\Hash::check($request->password, $password)) {
                return redirect(route('inboxMembre'));
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }
    }

    public function query(Request $request) {

        $telephone = $request->telephone;
        $password = $request->password;
        
        $etudiants = User::where('telephone', substr($telephone, 0, 11))->where('departement_id', substr($telephone, 11))->get();

        if(count($etudiants) == 0) {
            abort('404');
        } else {
            foreach ($etudiants as $etudiant) {
                session()->put('id', $etudiant->id);
                session()->put('nom_complet', $etudiant->name);
                session()->put('departement_id', $etudiant->departement_id);
                session()->put('category', "membre");
            }

            return redirect(route('inboxsMembre'));
        }
    }
}
