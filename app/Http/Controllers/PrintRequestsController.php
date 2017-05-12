<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class PrintRequestsController extends Controller
{



public function show()

{
  return view('/printrequests/details');
}

}
