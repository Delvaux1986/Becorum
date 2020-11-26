<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Notifications\NewCommentPosted;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Topic $topic,Request $request){
          $request->validate([
              'content' => 'required|min:5',
          ]);
          $comment = new Comment;
          $comment->content = request('content');
          $comment->user_id = Auth::user()->id;

          $topic->comments()->save($comment);

          // notification
          $topic->user->notify(new NewCommentPosted( $topic , Auth::user()));

          return redirect()->route('topics.show' , $topic);

    }

    public function storeCommentReply(Comment $comment, Request $request){
        $request->validate([
            'replyComment' => 'required|min:5',
        ]);

        $commentReply = new Comment;
        $commentReply->content = request('replyComment');
        $commentReply->user_id = Auth::user()->id;

        $comment->comments()->save($commentReply);

        Return redirect()->back();
    }
}
