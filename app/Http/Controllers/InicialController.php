<?php

namespace App\Http\Controllers;

use Khill\Lavacharts\Lavacharts;
use App\Request;
use Carbon\Carbon;
use App\Department;
use App\User;

class InicialController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth')->except(['post.index']);
    }


    public function index()
    {
        $totalNumberOfPrints = Request::where('status',1)->count();
        $printwithcolor = Request::where('status',1)->where('colored',1)->count();
        $printwithcolorpercent = round(($printwithcolor/$totalNumberOfPrints)* 100,2);

        $printwithoutcolor = Request::where('status',1)->where('colored',0)->count();
        $printwithoutcolorpercent = round(($printwithoutcolor/$totalNumberOfPrints)* 100,2);

        $todayDate = Carbon::now();
        $startDayDate = Carbon::now()->setTime(0,0,0);

        $todaysPrints =  Request::where('status',1)->where('due_date', '<=', $todayDate )->where('due_date','>=',$startDayDate)->count();

        $depart1 = Department::find(1)->users('id');
        $totalPrintsDep1 = Request::where('status',1)->where('owner_id','==',$depart1)->count();
        //dd($depart1);

        $totalNumberOfActiveUsers = User::where('blocked',0)->count();

        return view('home.index', compact('totalNumberOfPrints','printwithcolorpercent','printwithoutcolorpercent','todaysPrints','totalNumberOfActiveUsers'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function departmentStatistics($id)
    {
        $numberOfPrints = Request::where();

        return view('layout.statistics');
    }


}
