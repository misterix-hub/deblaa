<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about() {
        return view('about');
    }

    public function location() {
        return view('location');
    }

    public function partners() {
        return view('partner');
    }
}
