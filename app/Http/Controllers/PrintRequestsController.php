<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use App\Comment;
use App\User;
use App\Printer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePrintRequest;
use App\Http\Requests\UpdatePrintRequest;
use App\Mail\CompletionEmail;
use File;
use Mail;
use Route;

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
                        ->select('users.id as usersID', 'users.name', 'departments.id as depID', 'departments.name as dname', 'requests.*');

        $user=Auth::user();
        if($user->isPublisher() && Route::currentRouteName()!='printrequests.finished'){
            $requests->where('users.id',$user->id);
        }

        if(Route::currentRouteName()=='printrequests.finished'){
            $requests->where('status',1);
        }
        $requests->orderBy('description', 'ASC');

        $requests=$this->searchByKeyword($requests, $keyword)->paginate(10);

        $order='asc';
        $criteria='description';

        return view('printrequests.list', compact('requests', 'order', 'criteria','user'));
    }


    public function create()
    {
        return view('printrequests.create');
    }

    public function edit($id)
    {
        $request= Request::find($id);

        //$this->authorize('update', $request);
        $title = 'Edit request';
        return view('printrequests.edit', compact('title', 'request'));
    }


    public function store(CreatePrintRequest $request)
    {

        $name= $_FILES["file"]["name"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        $newRequest = new Request;
        $newRequest->owner_id = Auth::user()->id;
        $uniqueName=uniqid().".".pathinfo($name, PATHINFO_EXTENSION);
        $newRequest->file = $uniqueName;
        $newRequest->fill($request->all());


        if (!$newRequest->save()) {
            $message = ['message_error' => 'Failed to create request'];
        } else {
            $message = ['message_success' => 'Request created successfully'];
            if (is_dir(storage_path("app/print-jobs/$newRequest->owner_id/")) === false) {
                mkdir(storage_path("app/print-jobs/$newRequest->owner_id/"));
            }
            move_uploaded_file($tmp_name, storage_path("app/print-jobs/$newRequest->owner_id/")."$uniqueName");
        }
        return redirect()->route('create')->with($message);
    }

    /*{1}/edit*/
    public function update(UpdatePrintRequest $request)
    {
        $printRequest=Request::find($_POST['request_id']);
        $name= $_FILES["file"]["name"];
        //dd($name);
        $tmp_name = $_FILES["file"]["tmp_name"];
        if($name!=""){
            $oldFilename=$printRequest->file;
            $uniqueName=uniqid().".".pathinfo($name, PATHINFO_EXTENSION);
            $printRequest->file = $uniqueName;
        }
        if (!$printRequest->fill($request->all())->save()) {
            $message = ['message_error' => 'Failed to edit request'];
        } else {
            $message = ['message_success' => 'Request successfully edited'];
            if($name!=""){
                unlink(storage_path("app/print-jobs/$printRequest->owner_id/")."$oldFilename");
                move_uploaded_file($tmp_name, storage_path("app/print-jobs/$printRequest->owner_id/")."$uniqueName");
            }
        }
        return redirect()->route('list')->with($message);
    }


    public function destroy($id)
    {
        $currentRequest = Request::findOrFail($id);
        $comments = $currentRequest->comments->where('parent_id',null);

        foreach($comments as $comment){
            $commentsWithParent = $currentRequest->comments->where('parent_id',$comment['id']);
            foreach($commentsWithParent as $commentsParent){
                if($commentsWithParent->count() == 0){
                    $comment->delete();
                }
                else{
                    $commentsParent->delete();
                }
            }
        }


        /*foreach($commentsOfRequest as $commentRequest){
            $commentsOfRequestWithParent = Comment::where('request_id', $id)->where('parent_id',$commentRequest['id'])->get();
            if($commentsOfRequestWithParent->count() == 0) {
                $commentRequest->delete();
            }
            else{
                foreach ($commentsOfRequestWithParent as $commentRequestWithParent){
                    $commentRequestWithParent->delete();
                    if($commentsOfRequestWithParent->count() == 0) {
                        $commentRequest->delete();
                    }
                }
            }

        }*/


        //$currentRequest->delete();

        if (!$currentRequest->delete()) {
            $message = ['message_error' => 'Failed to delete request'];
        } else {
            $message = ['message_success' => 'Request successfully deleted'];
        }

        return redirect()->route('list')->with($message);
    }


    public function show($id)
    {
        $requestData=Request::find($id);
        //$requestData = DB::table('requests')->find($id);
        $userData = User::find(Request::find($id)->owner_id);
        $comments= Comment::where('request_id', $id)->orderBy('created_at')->paginate(5);
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
        DB::table('requests')->where('id', $id)->update(['printer_id'=>Input::get('name')+1]);
        $request=Request::find($id);
        $user=$request->users;
        Mail::to($user->email)->send(new CompletionEmail($request));
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
        DB::table('requests')->where('id', $id)->update(['status'=>2]);
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
        if(Route::currentRouteName()=='printrequests.finished'){
            $requests->where('status',1);
        }
        $requests=$this->searchByKeyword($requests, $keyword)->paginate(10);
        return view('printrequests.list', compact('requests', 'order', 'criteria','user'));
    }
}
