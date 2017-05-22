<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;



class CommentsController extends Controller
{

  public function block($requetsID,$commentID)
  {
    DB::table('comments')->where('id', $commentID)->update(['blocked'=>1]);
    return back();

  }





}
