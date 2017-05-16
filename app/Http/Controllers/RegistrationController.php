<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{


  public function __construct()
  {
    $this->middleware('guest');
  }


  public function create()

  {
    //eturn view('sessions.create');
    return view('registration.create');
  }

  public function store()
  {

//Validar a Form dos users

    $this->validate(request(), [

      'name' => 'required',

      'email' => 'required|email',

      'password' => 'required|confirmed',

      'admin' => 'required',

      'blocked' => 'required',

      'print_evals' => 'required',

      'print_counts' => 'required',

      'department_id' => 'required',

    ]);


//criar e guardar o user

$user = User::create(request(['name', 'email', 'password', 'admin', 'blocked', 'print_evals', 'print_counts', 'department_id']));


//iniciar sess

auth()->login($user);

//redirecionar para a pagina Admins (no inicio sera testado o redirect para a pagina Home)

return redirect()->home();



    }

}
