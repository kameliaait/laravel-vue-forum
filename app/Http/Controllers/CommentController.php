<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use App\Notifications\NewCommentPosted;

class CommentController extends Controller
{
    public function __constuct(){
    	$this->middleware('auth');
    }
    public function store(Topic $topic){
    	request()->validate([
        'content'=>'required|min:5'
    	]);
    	$comment = new Comment();
    	$comment->content = request('content');
    	$comment->user_id = auth()->user()->id;
    	$topic->comments()->save($comment);
        //notification
        $topic->user->notify(new NewCommentPosted($topic,auth()->user()));
    	return redirect()->route('topic.show',$topic);

    }
    public function storeCommentReply(Comment $comment){
    	request()->validate([
         'replyComment'=>'required|min:3',
    	]);
    	$commentReply = new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id = auth()->user()->id;
        $comment->comments()->save($commentReply);
        return redirect()->back();
    }
    public function markedAsSolution(Topic $topic, Comment $comment){
        if(auth()->user()->id == $topic->user_id){
            $topic->solution = $comment->id;
            $topic->save();
            return response()->json(['success'=>['marqueé comme solution']],200);
        }else{
            return response()->json(['errors'=>['Utilisateur non valide']],401);

        }
    }
}
