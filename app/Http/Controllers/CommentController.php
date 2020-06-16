<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderByDesc('created_at')->get();
        return view( 'comments.index', [ 'comments' => $comments ] );
    }
    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id)->delete();
        session()->flash('success_spam','comment is marked as a spam successfully');
        return redirect()->route('comments.index');
    }
}
