<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function login() {

        if (session()->has('category')) {
            if (session()->get('category') == "structure") {
                return redirect(route('indexStructure'));
            } else {
                if (session()->get('category') == "universite") {
                    return redirect(route('indexUniversite'));
                } else {
                    if (session()->get('category') == "membre") {
                        return redirect(route('inboxMembre'));
                    } else {
                        return redirect(route('inboxEtudiant'));
                    }
                }
            }
        } else {
            return view('etudiant.login');
        }
    }
}
