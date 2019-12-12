<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        return view('structure.message.liste');
    }

    public function create() {
        return view('structure.message.envoyer');
    }

    public function bilan() {
        return view('structure.message.bilan');
    }

    public function details($id) {
        return view('structure.message.details');
    }
}
