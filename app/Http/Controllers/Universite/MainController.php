<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use App\MessageUniversite;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;

class MainController extends Controller
{
    public function index() {

        if (!session()->has('category')) {
            return redirect(route('uLogin'));
        } else {
            if (session()->get('category') == "structure") {
                return redirect(route('indexStructure'));
            } else {
                return view('universite.index', [
                    'niveaux' => Niveau::all(),
                    'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                    'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                    'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                        ->where('universite_id', session()->get('id'))
                        ->where('users.id', '<>', null)
                        ->get()
                ]);
            }
            
        }
    }

    public function login() {
        if (session()->has('category')) {
            if (session()->get('category') == "structure") {
                return redirect(route('indexStructure'));
            } else {
                return redirect(route('indexUniversite'));
            }
        } else {
            return view('universite.login');
        }
    }
}
