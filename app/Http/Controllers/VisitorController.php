<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorController extends Controller 
{
    public function about() {
        return view('visitors.about');
    }

    public function tarification() {
        return view('visitors.tarification');
    }

    public function contact() {
        return view('visitors.contact');
    }
}