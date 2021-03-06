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

        //total number of prints
        $closedRequests = Request::where('status', 1)->get();
        $totalNumberOfPrints = 0;
        foreach ($closedRequests as $closed) {
            $totalNumberOfPrints += $closed->quantity;
        }

        //percentage of colored prints
        $printwithcolor = Request::where('status', 1)->where('colored', 1)->get();
        $totalNumberOfPrintsColor = 0;
        foreach ($printwithcolor as $color) {
            $totalNumberOfPrintsColor += $color->quantity;
        }
        $printwithcolorpercent = round(($totalNumberOfPrintsColor / $totalNumberOfPrints) * 100, 2);

        //percentage of black/white prints
        $printwithoutcolor = Request::where('status', 1)->where('colored', 0)->get();
        $totalNumberOfPrintsWithoutColor = 0;
        foreach ($printwithoutcolor as $nocolor) {
            $totalNumberOfPrintsWithoutColor += $nocolor->quantity;
        }
        $printwithoutcolorpercent = round(($totalNumberOfPrintsWithoutColor / $totalNumberOfPrints) * 100, 2);

        $todayDate = Carbon::now();
        $today = $todayDate->day;
        $todayDateFormatted = $todayDate->format('Y-m-d H:i:s');
        $firstDayMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        //Daily average of prints for the current month
        $monthPrints = Request::where('status', 1)->where('updated_at', '<=', $todayDateFormatted)->where('updated_at',
            '>=', $firstDayMonth)->get();
        $prints = 0;
        foreach ($monthPrints as $monthPrint) {
            $prints += $monthPrint->quantity;
        }
        $averageRequestsDay = round(($prints / $today), 2);

        $startDayDate = $todayDate->startOfDay();


        //todays prints
        $todaysPrintstotal = Request::where('status', 1)->where('updated_at', '<=',
            $todayDateFormatted)->where('updated_at', '>=', $startDayDate)->get();
        $todaysPrints = 0;
        foreach ($todaysPrintstotal as $value) {
            $todaysPrints += $value->quantity;
        }

        //total prints by department
        $countRequests = collect();
        $count = 0;
        $i = 0;
        $departmentsArray = Department::all();
        foreach ($departmentsArray as $value) {
            $departments = Department::find($value->id)->users->pluck('id');
            foreach ($departments as $depart) {
                $requestsCount = Request::where('status', 1)->where('owner_id', $depart)->get();
                foreach ($requestsCount as $request) {
                    $count += $request->quantity;
                }
                $numUsers = count($departments);
                if (++$i === $numUsers) {
                    $countRequests->push(['number_of_prints' => $count, 'department_name' => $value->name]);
                    $i = 0;
                    $count = 0;
                }
            }
        }

        $totalNumberOfActiveUsers = User::where('blocked', 0)->count();

        $data = [
            'totalNumberOfPrints' => $totalNumberOfPrints,
            'totalNumberOfPrintsColor' => $totalNumberOfPrintsColor,
            'totalNumberOfPrintsWithoutColor' => $totalNumberOfPrintsWithoutColor,
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
        //total copies
        $department = Department::find($id);
        $users = $department->users()->pluck('id');
        $totalPrints = 0;
        $totalNumberOfPrintsBlack = 0;
        $totalNumberOfPrintsColor = 0;

        $todayDate = Carbon::now();
        $today = $todayDate->day;
        $todayDateFormatted = $todayDate->format('Y-m-d h:i:s');
        $firstDayMonth = Carbon::now()->startOfMonth()->format('Y-m-d h:i:s');
        $startDayDate = $todayDate->setTime(0, 0, 0);
        $monthPrints = 0;
        $todaysPrints = 0;

        $closedRequests = Request::where('status', 1)->get();
        $totalNumberOfPrints = 0;
        foreach ($closedRequests as $closed) {
            $totalNumberOfPrints += $closed->quantity;
        }


        foreach ($users as $user_id) {

            //total prints
            $totalPrintsArray = Request::where('status', 1)->where('owner_id', $user_id)->get();
            foreach ($totalPrintsArray as $item) {
                $totalPrints += $item->quantity;
            }

            //P.b
            $totalNumberOfPrintsBlackArray = Request::where('status', 1)->where('colored', 0)->where('owner_id',
                $user_id)->get();
            foreach ($totalNumberOfPrintsBlackArray as $item1) {
                $totalNumberOfPrintsBlack += $item1->quantity;
            }

            //Cores
            $totalNumberOfPrintsColorArray = Request::where('status', 1)->where('colored', 1)->where('owner_id',
                $user_id)->get();
            foreach ($totalNumberOfPrintsColorArray as $item2) {
                $totalNumberOfPrintsColor += $item2->quantity;
            }

            $monthPrintsArray = Request::where('status', 1)->where('updated_at', '<=',
                $todayDateFormatted)->where('updated_at', '>=', $firstDayMonth)->where('owner_id', $user_id)->get();
            foreach ($monthPrintsArray as $item4) {
                $monthPrints += $item4->quantity;
            }

            $todaysPrintsArray = Request::where('status', 1)->where('updated_at', '<=',
                $todayDateFormatted)->where('updated_at', '>=', $startDayDate)->where('owner_id', $user_id)->get();
            foreach ($todaysPrintsArray as $item3) {
                $todaysPrints += $item3->quantity;
            }
        }

        if ($totalPrints == 0) {
            $printwithcolorpercent = "No prints found";
            $printwithoutcolorpercent = "No prints found";
        } else {
            $printwithcolorpercent = round(($totalNumberOfPrintsColor / $totalPrints) * 100, 2);
            $printwithoutcolorpercent = round(($totalNumberOfPrintsBlack / $totalPrints) * 100, 2);
        }

        $averageRequestsDay = round(($monthPrints / $today), 2);

        $data2 = [
            'department' => $department,
            'totalPrints' => $totalPrints,
            'printwithcolorpercent' => $printwithcolorpercent,
            'printwithoutcolorpercent' => $printwithoutcolorpercent,
            'todaysPrints' => $todaysPrints,
            'averageRequestsDay' => $averageRequestsDay
        ];

        return view('layout.statistics', compact('data2'));
    }

}
