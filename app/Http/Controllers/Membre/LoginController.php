<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function loginProcessing(Request $request) {

        $request->validate([
           'telephone' => 'required|regex:/(\+228)[9]([0-9]){7}/'
        ],
            [
                'telephone.required' => 'Le champ du téléphone est requis',
                'telephone.regex' => 'Numéro incorrect'
            ]);

        $membre_telephones = User::where('telephone', substr($request->telephone, 1))->get();

        if (count($membre_telephones) == 0) {
            return back()->with('error', "Numéro de téléphone incorrecte !");
        } else {
            foreach ($membre_telephones as $membre_telephone) {
                $telephone = $membre_telephone->telephone;
                $password = $membre_telephone->password;
                session()->put('id', $membre_telephone->id);
                session()->put('nom_complet', $membre_telephone->name);
                session()->put('departement_id', $membre_telephone->departement_id);
                session()->put('telephone', $telephone);
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

        $request->validate([
            'telephone' => 'required|regex:/(228)[9]([0-9]){7}/'
        ],
            [
                'telephone.required' => 'Le champ du téléphone est requis',
                'telephone.regex' => 'Numéro incorrect'
            ]);

        $telephone = $request->telephone;
        $password = $request->password;


       $membres = User::where('telephone' , $telephone)->get();

        if(count($membres) == 0) {
            return redirect(route('mLogin'));
        } else {
            foreach ($membres as $membre) {
                session()->put('id', $membre->id);
                session()->put('nom_complet', $membre->name);
                session()->put('departement_id', $membre->departement_id);
                session()->put('telephone', $membre->telephone);
                session()->put('category', "membre");
            }

            return redirect(route('inboxsMembre'));
        }
    }
}
