<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePrintRequest;
use App\Http\Requests\UpdatePrintRequest;

class PrintRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function list()
    {
        $keyword = Input::get('search', '');
        $requests = Request::join('users', 'users.id', '=', 'requests.owner_id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->select('users.id as usersID', 'users.name', 'departments.id as depID', 'departments.name as dname', 'requests.*')->orderBy('description', 'ASC');

        $user=Auth::user();
        if($user->isPublisher()){
            $requests->where('users.id',$user->id);
        }
        $requests=$this->searchByKeyword($requests, $keyword)->paginate(5);
        $order='asc';
        $criteria='description';
        return view('printrequests.list', compact('requests', 'order', 'criteria'));
    }

    public function create()
    {
        return view('printrequests.create');
    }

    public function edit(Request $request)
    {
        //$this->authorize('update', $request);
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
        return redirect()->route('create')->with($message);
    }

    /*{1}/edit*/
    public function update(UpdatePrintRequest $request, Request $requestValue)
    {

        //$this->authorize('update', $requestValue);

        $requestValue->owner_id = Auth::user()->id;
        $requestValue->fill($request->all());
        $requestValue->file = Input::get('file');
        if (!$requestValue->save()) {
            $message = ['message_error' => 'Failed to edit request'];
        } else {
            $message = ['message_success' => 'Request successfully edited'];
        }
        return redirect()->route('printrequests.dashboard')->with($message);
    }


    public function destroy($id)
    {
        $currentRequest = Request::findOrFaiil($id);
        $currentRequest->delete();
        $currentRequest->session()->flash('alert-success', ' Request successfully deleted!');

        if (!$id->delete()) {
            $message = ['message_error' => 'Failed to remove user'];
        } else {
            $message = ['message_success' => 'Request successfully deleted'];
        }

        return redirect()->route('printrequests.dashboard')->with($message);
    }


    public function show($id)
    {
        $requestData=Request::find($id);
        //$requestData = DB::table('requests')->find($id);
        $userData = User::find(Request::find($id)->owner_id);
        $comments= Comment::where('request_id', $id)->orderBy('created_at')->get();
        $userDepartment = DB::table('departments')->find(User::find(Request::find($id)->owner_id)->department_id);
        $printers=DB::table('printers')->distinct()->pluck('name');
        $user = Auth::user();

        if ($user->isAdmin()||$user->id == $requestData->owner_id) {
            return view('printrequests.details', compact('requestData', 'userData', 'userDepartment', 'comments', 'printers', 'user'));
        }
    }

    public function download($id)
    {
        $ownerID=Request::find($id)->owner_id;
        $requestFile = (string)Request::find($id)->file;
        return response()->download(storage_path("app/print-jobs/$ownerID/$requestFile"));
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

    public function searchByKeyword($query, $keyword)
    {
        $status=Request::strToTypeState($keyword);
        if (is_null($keyword)==false) {
            $query->where(function ($query) use ($keyword, $status) {
                $query->where("requests.description", "like", "%$keyword%")
                    ->orWhere("requests.due_date", "like", "%$keyword%")
                    ->orWhere("requests.status", "like", "%$status%")
                    ->orWhere("departments.name", "like", "%$keyword%")
                    ->orWhere("users.name", "like", "%$keyword%");
            });
        }
        return $query;
    }

    public function order($criteria, $order)
    {
        if ($order=='asc') {
            $order='desc';
        } else {
            $order='asc';
        }
        $keyword = Input::get('search', '');
        $requests = Request::join('users', 'users.id', '=', 'requests.owner_id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->select('users.id as usersID', 'users.name', 'departments.id as depID', 'departments.name as dname', 'requests.*');
        if ($criteria == "employee") {
            $requests->orderBy('users.name', "$order");
        }
        if ($criteria == "date") {
            $requests->orderBy('due_date', "$order");
        }
        if ($criteria == "description") {
            $requests->orderBy('description', "$order");
        }
        if ($criteria == "paper") {
            $requests->orderBy('paper_type', "$order");
        }
        if ($criteria == "status") {
            $requests->orderBy('status', "$order");
        }
        if ($criteria == "department") {
            $requests->orderBy('users.department_id', "$order");
        }
        $user=Auth::user();
        if($user->isPublisher()){
            $requests->where('users.id',$user->id);
        }
        $requests=$this->searchByKeyword($requests, $keyword)->paginate(5);
        return view('printrequests.list', compact('requests', 'order', 'criteria'));
    }
}
