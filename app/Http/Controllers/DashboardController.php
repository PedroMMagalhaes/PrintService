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



}
