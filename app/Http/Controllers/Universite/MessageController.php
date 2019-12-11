<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        return view('universite.message.liste');
    }

    public function create() {
        return view('universite.message.envoyer');
    }

    public function bilan() {
        return view('universite.message.bilan');
    }

    public function details($id) {
        return view('universite.message.details');
    }
}
