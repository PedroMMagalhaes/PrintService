<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePrintRequest;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {

        $keyword = Input::get('keyword', '');
        $user = Auth::user();
        if ( Auth::check() && $user->isAdmin() )
       {
           $requests = Request::SearchByKeyword($keyword)->orderBy('description','ASC')->paginate(5);
       }else{
           $requests = Request::SearchByKeyword($keyword)->where('owner_id',$user->id)->orderBy('description','ASC')->paginate(5);
       }

        $order='ASC';
        $criteria='id';

        return view('printrequests.dashboard', compact('requests','order','criteria'));
    }

}
