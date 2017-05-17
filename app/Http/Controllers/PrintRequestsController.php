<?php

namespace App\Http\Controllers;

use App\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class PrintRequestsController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest');
  }


  public function list()
  {
      //$fetchrequests = DB::table('requests')->latest()->get();
      $fetchRequests = Request::all();
      $fetchRequests = Request::paginate(10);

      return view('printrequests.list', compact('fetchRequests'));
  }


    public function show($id)
    {
        $request=Request::find($id);
        $requestData = DB::table('requests')->find($id);
        $userData = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
        $userDepartment = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
        return view('/printrequests/details', compact('requestData', 'userData', 'userDepartment','request'));
    }

    public function download($id)
    {
        return response()->download(storage_path('app/print-jobs/3/566153ff-f7a4-3e2e-b02f-833589ad32a0.odt'));
    }
}
