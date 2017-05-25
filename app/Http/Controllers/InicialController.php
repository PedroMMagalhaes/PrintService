<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class InicialController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth')->except(['post.index']);
    }


    public function index()
    {
        $totalNumberOfPrints = \App\Request::where('status',1)->count();
        $printwithcolor = \App\Request::where('status',1)->where('colored',1)->count();
        $printwithcolorpercent = round(($printwithcolor/$totalNumberOfPrints)* 100,2);

        $printwithoutcolor =\App\Request::where('status',1)->where('colored',0)->count();
        $printwithoutcolorpercent = round(($printwithoutcolor/$totalNumberOfPrints)* 100,2);

        return view('home.index', compact('totalNumberOfPrints','printwithcolorpercent','printwithoutcolorpercent'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function departmentStatistics()
    {
        return view('layout.statistics');
    }


}
