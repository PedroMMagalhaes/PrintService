<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use App\Comment;
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
        $requests = Request::SearchByKeyword($keyword)->orderBy('description','ASC')->paginate(5);
        $order='ASC';

        return view('printrequests.list', compact('requests','order'));
    }

    public function create()
    {
        return view('printrequests.create');
    }

    public function edit(Request $request)
    {
        $title = 'Edit request';
        return view('printrequests.edit', compact('title', 'request'));
    }



    public function store(CreatePrintRequest $request)
    {
        $newRequest = new Request;
        $newRequest->owner_id = Auth::user()->id;
        $newRequest->fill($request->all());
        $newRequest->file = $_FILES["file"]["name"];
        $name= $_FILES["file"]["name"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        if (is_dir(storage_path("app/print-jobs/$newRequest->owner_id/")) === false) {
            mkdir(storage_path("app/print-jobs/$newRequest->owner_id/"));
        }
        move_uploaded_file($tmp_name, storage_path("app/print-jobs/$newRequest->owner_id/")."$name");

        if (!$newRequest->save()) {
            $message = ['message_error' => 'Failed to create request'];
        } else {
            $message = ['message_success' => 'Request created successfully'];
        }
        return redirect()->route('create')->with('message', 'teste');
    }

    /*{1}/edit*/
    public function update(CreatePrintRequest $request, $id)
    {

        $currentRequest = Request::findOrFaiil($id);

        $currentRequest->owner_id = Auth::user()->id;
        $currentRequest->fill($request->all());
        $currentRequest->file = Input::get('file');
        if (!$currentRequest->save()) {
            $message = ['message_error' => 'Failed to edit request'];
        } else {
            $message = ['message_success' => 'Request successfully edited'];
        }
        return Redirect::route('printrequests.dashboard')->with($message);
    }


    public function destroy($id)
    {
        $currentRequest = Request::findOrFaiil($id);
        $currentRequest->delete();
        $currentRequest->session()->flash('alert-success', ' Request deleted successfully.');

        if (!$id->delete()) {
            $message = ['message_error' => 'Failed to remove user'];
        }

        return Redirect::route('printrequests.dashboard');
    }


    public function show($id)
    {
        $requestData=Request::find($id);
        //$requestData = DB::table('requests')->find($id);
        $userData = DB::table('users')->find(DB::table('requests')->find($id)->owner_id);
        $comments= Comment::where('request_id',$id)->orderBy('created_at')->get();
        $userDepartment = DB::table('departments')->find(DB::table('users')->find(DB::table('requests')->find($id)->owner_id)->department_id);
        $printers=DB::table('printers')->distinct()->pluck('name');
        $user = Auth::user();
        if($user->isAdmin()||$user->id == $requestData->owner_id){
            return view('printrequests.details', compact('requestData', 'userData', 'userDepartment', 'comments', 'printers','user'));
        }
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
        DB::table('requests')->where('id', $id)->update(['status'=>1]);
        $printerID=DB::table('printers')->distinct()->find(request('name'))->id;
        DB::table('requests')->where('id', $id)->update(['printer_id'=>$printerID]);
        return back();
    }

    public function setRating($id)
    {
        DB::table('requests')->where('id', $id)->update(['satisfaction_grade'=>request('satisfaction')]);
        return back();
    }

    public function refuseRequest($id)
    {
        DB::table('requests')->where('id', $id)->update(['refused_reason'=>request('refuseReason')]);
        return back();
    }

    public function order($criteria, $order)
    {
        //$keyword = Input::get('keyword', '');
        //$requests = Request::SearchByKeyword($keyword)->paginate(5);
        if($order=='ASC'){
            $order='DESC';
        }else{
            $order='ASC';
        }
        $keyword = Input::get('keyword', '');
        if($criteria == "empl"){
        $requests = Request::join('users', 'users.id', '=', 'requests.owner_id')->select('users.id as usersID', 'users.name', 'requests.*')->SearchByKeyword($keyword)->orderBy('users.name',"$order")->paginate(5);
        }
        if($criteria == "date"){
        $requests = Request::SearchByKeyword($keyword)->orderBy('due_date',"$order")->paginate(5);
        }
        if($criteria == "desc"){
        $requests = Request::SearchByKeyword($keyword)->orderBy('description',"$order")->paginate(5);
        }
        if($criteria == "pape"){
        $requests = Request::SearchByKeyword($keyword)->orderBy('paper_type',"$order")->paginate(5);
        }
        if($criteria == "stat"){
        $requests = Request::SearchByKeyword($keyword)->orderBy('status',"$order")->paginate(5);
        }
        if($criteria == "depa"){
        $requests = Request::join('users', 'users.id', '=', 'requests.owner_id')->orderBy('users.name',"$order");
        $requests = Request::join('users', 'users.department_id', '=', 'department.id')->SearchByKeyword($keyword)->paginate(5);
        }
        return view('printrequests.list', compact('requests','order'));
    }
}
