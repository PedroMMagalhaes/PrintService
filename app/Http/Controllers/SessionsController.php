<?php

namespace App\Http\Controllers;
use App\User;
use Auth;

use Illuminate\Http\Request;

class SessionsController extends Controller
{


  public function __contruct()

  {
    $this->middleware('guest', ['except' => 'destroy']);

  }


  public function create()

  {
    return view ('sessions.create');

  }


  public function store()

  { //tentar autenticar o user

    if(! auth()->attempt(request(['email', 'password']))){

      return back()->withErrors([

        'message' => 'Please check your credentials and try again.'
      ]);
    }

    return redirect()->home();
  }


  public function profile()

  {

    //auth()->login($user);

    return view('user.profile', array('user' => Auth::user()) );

  }

  public function destroy()

  {

    auth()->logout();

    return redirect()->home();

  }


}
