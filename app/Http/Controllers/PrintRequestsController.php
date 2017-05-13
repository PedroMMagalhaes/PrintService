<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrintRequestsController extends Controller
{



public function show($id)
{
  $requestData = DB::table('requests')->find($id);
  $userData = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
  $userDepartment = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
  return view('/printrequests/details', compact('requestData','userData','userDepartment'));
}

public function download($id)
{
    return response()->download(storage_path('app/print-jobs/3/566153ff-f7a4-3e2e-b02f-833589ad32a0.odt'));
}

}
