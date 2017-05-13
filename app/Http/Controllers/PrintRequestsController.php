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

public function download($id)
{
    return response()->download(storage_path('app/print-jobs/3/566153ff-f7a4-3e2e-b02f-833589ad32a0.odt'));
}

}
