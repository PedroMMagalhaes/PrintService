<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicialController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth')->except(['post.index']);
    }


    public function index()
    {
        return view('home.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
