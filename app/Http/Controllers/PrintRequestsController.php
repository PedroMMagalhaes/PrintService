<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrintRequestsController extends Controller
{



public function show($id)

{
  $dadosImpressao = DB::table('requests')->find($id);
  $dadosUtilizador = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
  $departamentoUtilizador = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
  return view('/printrequests/details', compact('dadosImpressao','dadosUtilizador','departamentoUtilizador'));
}

}
