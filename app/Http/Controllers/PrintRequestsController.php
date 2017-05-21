<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePrintRequest;

class PrintRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function list()
    {

        $keyword = Input::get('keyword', '');
        $requests = Request::SearchByKeyword($keyword)->paginate(5);

        return view('printrequests.list', compact('requests'));
    }

    public function create()
    {
        return view('printrequests.create');
    }

    public function store(CreatePrintRequest $request)
    {

        $newRequest = new Request;

        $newRequest->description = Input::get('description');
        $newRequest->due_date = Input::get('due_date');
        $newRequest->quantity = Input::get('quantity');
        $newRequest->colored = Input::get('print_type');
        $newRequest->stapled = Input::get('stapled');
        $newRequest->owner_id = Auth::user()->id;

        if (!$newRequest->save()) {
            $message = ['message_error' => 'Failed to create request'];
        }
        else{
            $message = ['message_success' => 'Request created successfully'];
        }
        return redirect()->route('create')->with($message);
    }

    /*/{1}/edit*/
    /*public function store(CreatePrintRequest $request, $id)
    {

    $newRequest = Request::findOrFaiil($id);
        $newRequest = new Request;

        $newRequest->description = Input::get('description');
        $newRequest->due_date = Input::get('due_date');
        $newRequest->quantity = Input::get('quantity');
        $newRequest->colored = Input::get('print_type');
        $newRequest->stapled = Input::get('stapled');
        $newRequest->owner_id = Auth::user()->id;

        if (!$newRequest->save()) {
            $message = ['message_error' => 'Failed to create request'];
        }
        else{
            $message = ['message_success' => 'Request created successfully'];
        }
        return redirect()->route('create')->with($message);
    }*/



    public function show($id)
    {
        $request=Request::find($id);
        $requestData = DB::table('requests')->find($id);
        $userData = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
        $userDepartment = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
        $printers=DB::table('printers')->distinct()->pluck('name');
        return view('/printrequests/details', compact('requestData', 'userData', 'userDepartment', 'request', 'printers'));
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
        $printerID=DB::table('printers')->distinct()->find(request('name'))->id;
        DB::table('requests')->where('id',$id)->update(['printer_id'=>$printerID]);
        return back();
    }

    public function setRating($id){
        DB::table('requests')->where('id',$id)->update(['satisfaction_grade'=>request('satisfaction')]);
        return back();
    }

    public function refuseRequest($id){
        DB::table('requests')->where('id',$id)->update(['refused_reason'=>request('refuseReason')]);
        return back();

    }

}
