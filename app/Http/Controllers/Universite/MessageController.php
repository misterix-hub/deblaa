<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.liste');
        }
    }

    public function create() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.envoyer');
        }
    }

    public function bilan() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.bilan');
        }
    }

    public function details($id) {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.details');
        }
    }
}
