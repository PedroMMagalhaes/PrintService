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
        $today = $todayDate->day;
        $todayDateFormatted = $todayDate->format('Y-m-d h:i:s');
        $firstDayMonth = Carbon::now()->startOfMonth()->format('Y-m-d h:i:s');

        $monthPrints = Request::where('status',1)->where('due_date', '<=', $todayDateFormatted )->where('due_date','>=',$firstDayMonth)->count();
        $averageRequestsDay = round(($monthPrints / $today),2);


        $startDayDate = $todayDate->setTime(0,0,0);

        $todaysPrints =  Request::where('status',1)->where('due_date', '<=', $todayDateFormatted )->where('due_date','>=',$startDayDate)->count();


        $countRequests = collect();
        $count = 0;
        $i = 0;
        foreach(Department::all() as $departamentVariable)
        {
            $departments = Department::find($departamentVariable->id)->users()->pluck('id');
            foreach( $departments as $depart) {
                $count += Request::where('status',1)->where('owner_id',$depart)->count();
                $numUsers = count($departments);
                if(++$i === $numUsers) {
                    $countRequests->push(['numero_impressoes' => $count, 'nome_departamento' => $departamentVariable->name]);
                    $i = 0;
                    $count = 0;
                }
            }
        }
        //dd($countRequests);

        $totalNumberOfActiveUsers = User::where('blocked',0)->count();

        $data = [
            'totalNumberOfPrints' => $totalNumberOfPrints,
            'printwithcolorpercent' => $printwithcolorpercent,
            'printwithoutcolorpercent' => $printwithoutcolorpercent,
            'todaysPrints' => $todaysPrints,
            'totalNumberOfActiveUsers' => $totalNumberOfActiveUsers,
            'countRequests' => $countRequests,
            'averageRequestsDay' => $averageRequestsDay
        ];

        return view('home.index', compact('data'));
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
        //TOTAL COPIES
        $department = Department::find($id);
        $users = $department->users()->pluck('id');
        $totalPrints = 0;
        $totalNumberOfPrintsBlack = 0;
        $totalNumberOfPrintsColor = 0;

        $todayDate = Carbon::now();
        $today = $todayDate->day;
        $todayDateFormatted = $todayDate->format('Y-m-d h:i:s');
        $firstDayMonth = Carbon::now()->startOfMonth()->format('Y-m-d h:i:s');
        $startDayDate = $todayDate->setTime(0,0,0);
        $monthPrints = 0;
        $todaysPrints = 0;

        foreach($users as $user_id){
            $totalPrints += Request::where('status',1)->where('owner_id',$user_id)->count();
            //P.b
            $totalNumberOfPrintsBlack += Request::where('status',1)->where('colored',0)->where('owner_id',$user_id)->count();
            //Cores
            $totalNumberOfPrintsColor += Request::where('status',1)->where('colored',1)->where('owner_id',$user_id)->count();

            $monthPrints += Request::where('status',1)->where('due_date', '<=', $todayDateFormatted )->where('due_date','>=',$firstDayMonth)->where('owner_id',$user_id)->count();

            $todaysPrints +=  Request::where('status',1)->where('due_date', '<=', $todayDateFormatted )->where('due_date','>=',$startDayDate)->where('owner_id',$user_id)->count();
        }

        if($totalPrints == 0) {
            $printwithcolorpercent = "No prints found";
            $printwithoutcolorpercent = "No prints found";
        }
        else{
            $printwithcolorpercent = round(($totalNumberOfPrintsColor/$totalPrints)* 100,2);
            $printwithoutcolorpercent = round(($totalNumberOfPrintsBlack/$totalPrints)* 100,2);
        }

        $averageRequestsDay = round(($monthPrints / $today),2);

        $data = [
            'department' => $department,
            'totalPrints' => $totalPrints,
            'printwithcolorpercent' => $printwithcolorpercent,
            'printwithoutcolorpercent' => $printwithoutcolorpercent,
            'todaysPrints' => $todaysPrints,
            'averageRequestsDay' => $averageRequestsDay
        ];

        return view('layout.statistics',compact('data'));
    }


}
