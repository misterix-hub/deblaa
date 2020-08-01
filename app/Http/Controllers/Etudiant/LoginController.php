<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {

        $request->validate([
            'telephone' => 'required|regex:/(\+228)[9]([0-9]){7}/'
        ], [
            'telephone.required' => 'Le champ du téléphone est requis',
            'telephone.regex' => 'Votre numéro est incorrect'
        ]);

        $etudiant_telephones = User::where('telephone', substr($request->telephone, 1))->get();

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
                session()->put('telephone', $telephone);
                session()->put('category', "etudiant");
            }

            if (\Hash::check($request->password, $password)) {
                return redirect(route('inboxEtudiant'));
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }
    }

    public function query(Request $request) {

        $request->validate([
            'telephone' => 'required|regex:/(228)[9]([0-9]){7}/',
            'keyaccess' => 'required'
        ], [
            'telephone.required' => 'Le champ du téléphone est requis',
            'telephone.regex' => 'Votre numéro est incorrect',
            'keyaccess.required' => 'clé d\'accès non renseigné'
        ]);

        $telephone = $request->telephone;
        $keyaccess = $request->keyaccess;

        $etudiants = User::where('filiere_id', '<>', null)->where('telephone', $telephone)->where('access_id', $keyaccess)->get();

        if(count($etudiants) == 0) {
            return redirect()->route('eLogin');
        } else {
            foreach ($etudiants as $etudiant) {
                session()->put('id', $etudiant->id);
                session()->put('nom_complet', $etudiant->name);
                session()->put('filiere_id', $etudiant->filiere_id);
                session()->put('niveau_id', $etudiant->niveau_id);
                session()->put('telephone', $etudiant->telephone);
                session()->put('category', "etudiant");
            }

            return redirect(route('inboxEtudiant'));
        }
    }

    public function logout() {
        session()->flush();

        return redirect(route('eLogin'));
    }
}
