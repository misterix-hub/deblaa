<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('universite.index');
    }

    public function login() {
        
    }
}
