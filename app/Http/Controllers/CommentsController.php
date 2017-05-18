<?php

namespace App\Http\Controllers;

use Illuminate\Http\Comment;
use App\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{

  public function static getUserName($userID)
  {
    $authorName=DB::table('users')->find($userID)->name;
    return $authorName;


  }





}
