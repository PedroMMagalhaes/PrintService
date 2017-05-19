<?php

namespace App\Http\Controllers;

use App\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PrintRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function list()
    {

        //$search = \Request::get('search');
        //$requests = Request::where('description','like','%'.$search.'%')->orderBy('id')->paginate(20);

        //$requests = Request::all();
        //$requests = Request::paginate(5);

        $keyword = Input::get('keyword', '');
        $requests = Request::SearchByKeyword($keyword)->paginate(5);

        return view('printrequests.list', compact('requests'));
    }


    public function show($id)
    {
        $request=Request::find($id);
        $requestData = DB::table('requests')->find($id);
        $userData = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
        $userDepartment = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
        return view('/printrequests/details', compact('requestData', 'userData', 'userDepartment', 'request'));
    }

    public function download($id)
    {
        $ownerID=Request::find($id)->owner_id;
        $requestFile = (string)Request::find($id)->file;
        return response()->download(storage_path("app/print-jobs/$ownerID/$requestFile"));
    }

    public function getCommentName($userID)
    {
        return DB::table('users')->find($userID)->name;
    }

    public function setComplete($id)
    {
        DB::table('requests')->where('id',$id)->update(['status'=>1]);
        return back();
    }

}
