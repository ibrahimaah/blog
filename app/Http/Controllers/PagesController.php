<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Post;
use App\Category;
use App\PostLike;

class PagesController extends Controller
{
    public function getHome()
    {
        //$posts = POST::orderBy('created_at','desc')->take(5)->get();
        $posts = POST::orderBy('created_at','desc')->paginate(5);
        
        $new_articles = POST::select('title','slug')->orderBy('created_at','desc')->take(7)->get();
        $most_viewed = POST::get()->where('views','>',0)->sortByDesc('views')->take(7);
        $posts_likes = PostLike::select('post_id',PostLike::raw('SUM(like_post) as total_likes'))->where('like_post',1)->groupBy('post_id')->orderBy('total_likes','desc')->take(7)->get();

        /**
         * Create associative array key:post_id , value:num_of_likes
         */
        $arr_posts_ids_with_likes = [];
        foreach($posts_likes as $post_like):
            $arr_posts_ids_with_likes[$post_like->post_id]=$post_like->total_likes;
        endforeach;

        return view('Pages.Home',[
            'posts'                   => $posts ,
            'new_articles'            => $new_articles , 
            'most_viewed'             => $most_viewed ,
            'arr_posts_ids_with_likes' => $arr_posts_ids_with_likes
            ]);
    }
    public function getAbout()
    {
        return view('Pages.About');
    }
    public function getContact()
    {
        return view('Pages.Contact');
    }
    public function getPostsByCategory($cat_id)
    {
        $posts = Post::where('category_id','=',$cat_id)->paginate(5);
        $category = Category::findOrFail($cat_id);
        return view('Pages.PostsByCat')->withPosts($posts)->withCategory($category);
    }
    
}
