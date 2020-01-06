<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\MessageStructure;
use App\Models\Departement;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        if (!session()->has('category')) {
            return redirect(route('sLogin'));
        } else {
            if (session()->get('category') == "universite") {
                return redirect(route('indexUniversite'));
            } else {
                if (session()->get('category') == "structure") {                    
                    return view('structure.index',[
                        'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                        'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                        'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                            ->where('structure_id', session()->get('id'))
                            ->where('users.id', '<>', null)
                            ->get(),
                        'fichier_messages' => MessageStructure::rightJoin('fichier_message_structures', 'message_structures.id', 'message_structure_id')
                                    ->where('message_structure_id', session()->get('id'))
                                    ->get()
                    ]);
                } else {
                    if (session()->get('category') == "membre") {
                        return redirect(route('inboxMembre'));
                    } else {
                        return redirect(route('inboxEtudiant'));
                    }
                    
                }
            }
        }
    }

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
            return view('structure.login');
        }
    }

    public function register() {
        return view('structure.register');
    }
}
