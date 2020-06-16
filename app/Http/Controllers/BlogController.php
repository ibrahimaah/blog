<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostView;
use App\Comment;
use App\PostLike;
use Auth;
use Response;
use DB;

class BlogController extends Controller
{
    public function getSingle(Request $request , $slug)
    {
        //u can google about first() vs get()
        $post = POST::where('slug','=',$slug)->firstOrFail();
        /**
         * get number of likes and dislikes for this post
        */
        $likes = PostLike::count_likes($post->id);
        $dislikes = PostLike::count_dislikes($post->id);
        //dd($post->id);
        //dd(PostLike::count_likes($post->id));
        //dd(session()->getId());
        /* calculate views for each post */
        //if the user has logged 
        if(Auth::check())
        {
            $post_viewed = PostView::where('titleslug',$slug)->where('user_id', Auth::id())->first();
            if(!isset($post_viewed))
            {
                PostView::createViewLog($post); 
                $post->increment('views');
            }
        }
        else
        {
            $post_viewed = PostView::where('titleslug',$slug)->where('session_id', session()->getId())->first();
            if(!isset($post_viewed))
            {
                PostView::createViewLog($post); 
                $post->increment('views');
            }
        }


        /* Comments */
        $comments = Comment::where('post_id',$post->id)->orderByDesc('created_at')->get();
        //get number of comments per post
        $comms = Comment::where('post_id',$post->id)->get();
        $comments_count = $comms->count();


        //Check wether current user has liked the post or not
        /**
         * We have 4 cases : 
         * 1- user is guest
         * 2- user is auth and has no interaction with the post
         * 3- user has liked the post
         * 4- user has disliked the post
         */
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $post_id = $post->id;
            
            $liked =PostLike::where('user_id',$user_id)->where('post_id',$post_id)->where('like_post',1)->exists();
            $disliked =PostLike::where('user_id',$user_id)->where('post_id',$post_id)->where('like_post',0)->exists();
            
            //dd(json_encode($disliked));
        }
        else
        {
            $liked = null;
            $disliked = null;
        }
        //dd($post->pivot);
        $arr_post_tags_ids =[];
        foreach($post->tags as $tag){
            $arr_post_tags_ids[] = $tag->id;
        }
        //dd($arr_post_tags_ids);
        $related_posts_ids = DB::table('post_tag')->select('post_id')->whereIn('tag_id',$arr_post_tags_ids)->distinct()->get();

        $arr_related_posts_ids = [];
        foreach($related_posts_ids as $related_post_id){
            $arr_related_posts_ids[] = $related_post_id->post_id;
        }
        //dd($arr_related_posts_ids);
        //dd($related_posts_ids);
        $related_posts = POST::whereIn('id',$arr_related_posts_ids)->take(15)->get();
        
        return view('blog.single',[
            'post'           => $post , 
            'comments'       => $comments ,
            'comments_count' => $comments_count,
            'liked'          => $liked ,
            'disliked'       => $disliked ,
            'likes'          => $likes ,
            'dislikes'       => $dislikes ,
            'related_posts'  => $related_posts
        ]);
    }

    public function ajax_like(Request $request)
    {
       
        $state  = $request->state;
        $post_id = $request->post_id;

        //maybe the user has interacted with the post before
        $user_interaction = PostLike::where('user_id' , Auth::user()->id)->Where('post_id'  ,$post_id)->exists();
        if($user_interaction){
            PostLike::where('user_id' , Auth::user()->id)->Where('post_id'  ,$post_id)->delete();
        }

        if($state == 'add_like' || $state == 'add_dislike')
        {
            $like_record = new PostLike();
            $like_record->post_id = $post_id;
            $like_record->user_id = Auth::id();
            $like_record->like_post = ($state=='add_like') ? 1 : 0 ;
            $like_record->save();
            //dd(json_encode($like_record));
        }

        $likes = PostLike::count_likes($post_id);//number of likes for this post
        $dislikes = PostLike::count_dislikes($post_id);//number of dislikes for this post

        $arr_response = array(
            "likes"   => $likes ,
            "dislikes" => $dislikes
        );
        //dd($saved);
        return response()->json($arr_response);
    }

    public function add_comment(Request $request , $post_id)
    {
        if(Auth::check()){
            $request->validate([
                'comment' => 'filled'
            ]);
            $comment = new Comment();
            $comment->comment = utf8_encode($request->comment);
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $post_id;
            $comment->save();
            session()->flash('success_comment','Thanks for your comment :)');
            $slug = $comment->post->slug;
        }else{
            $post = POST::findOrFail($post_id);
            $slug = $post->slug;
            session()->flash('cannt_comment','You have to Login First ');
        }
        
        return redirect()->route('blog.single', $slug);
    }

    public function edit($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        return view('blog.edit-comment',[ 'comment' => $comment ]);
    }

    public function update(Request $request , $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->comment = utf8_encode($request->comment);
        $comment->save();
        session()->flash('success_comment','Your comment updated successfully :)');
        $slug = $comment->post->slug;
        return redirect()->route('blog.single',$slug);
    }

    public function destroy(Request $request , $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        session()->flash('success_comment','Your comment deleted successfully :)');
        $slug = $comment->post->slug;
        return redirect()->route('blog.single',$slug);
    }


}
