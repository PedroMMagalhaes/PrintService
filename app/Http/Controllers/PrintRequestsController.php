<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrintRequestsController extends Controller
{



public function show($id)

{
    $dados = DB::table('requests')->find($id);
  return view('/printrequests/details', compact('dados'));
}

}
