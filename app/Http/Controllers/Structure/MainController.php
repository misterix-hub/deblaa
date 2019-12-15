<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\MessageStructure;
use App\Models\Departement;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('structure.index',[
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                "users" => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()
            ]);
        }
    }

    public function login() {
        return view('structure.login');
    }
}
