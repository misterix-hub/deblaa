<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;

class MainController extends Controller
{
    public function index() {

        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.index', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get()
            ]);
        }
    }

    public function login() {
        return view('universite.login');
    }
}
