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
            }

            if (\Hash::check($request->password, $password)) {
                return redirect(route('inboxMembre'));
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }
    }
}
