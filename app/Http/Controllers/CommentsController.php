<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use App\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class CommentsController extends Controller
{

    public function block($requetsID, $commentID)
    {
        Comment::where('id', $commentID)->update(['blocked' => 1]);
        return back();

    }

    public function createComment($requestID, $commentID = null)
    {
        $newComment = new Comment;
        $newComment->comment = request('comment');
        $newComment->blocked = 0;
        $newComment->request_id = $requestID;
        $newComment->parent_id = $commentID;
        $newComment->user_id = Auth::user()->id;
        $newComment->save();
        return back();


    }

    public function showBlockedComments()
    {
        $blockedComments = Comment::where('blocked', 1)->paginate(5);

        return view('comments.blockedComments', compact('blockedComments'));
    }

    public function unblockComments($commentID)
    {
        Comment::where('id', $commentID)->update(['blocked' => 0]);

        return back();
    }


}
