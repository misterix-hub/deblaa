<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function inbox() {
        return view('etudiant.inbox');
    }

    public function inboxs() {
        return view('etudiant.inboxs');
    }
}
