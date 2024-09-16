<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index()
    {
        return view('auth.selection');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function loginForm($type)
    {
        return view('auth.login2',compact('type'));

    }
}
