<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class BlogTagController extends Controller
{
    public function get_by_tag($tag_name){

        $tag_id = Tag::where('name',$tag_name)->value('id');
        $arr_posts_ids=[];
        $posts = POST::all();
        foreach($posts as $post){
            foreach($post->tags as $tag){//get the tags related to this post
                if($tag->id == $tag_id){//$tag->id ~ $tag->pivot->tag_id
                    $arr_posts_ids[]=$tag->pivot->post_id;
                }
            }
        }
        $posts = POST::whereIn('id',$arr_posts_ids)->get();
        
        return view('blog.posts-by-tag',['posts'=>$posts]);
    }
}
