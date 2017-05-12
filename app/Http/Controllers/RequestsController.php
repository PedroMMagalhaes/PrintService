<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestsController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
  }


  public function list()
  {
    return view('printrequests.list');
  }
}
