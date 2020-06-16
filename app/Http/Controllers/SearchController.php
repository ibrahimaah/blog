<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function get_search_res(Request $request){
        $request->validate([
            'search_word'=> 'required'
        ]);
       if(isset($request->search_word)){
           $search_word = $request->search_word ;
       }
       $posts = POST::where("title",'like',"%$search_word%")->orWhere("body",'like',"%$search_word%")->get();
       $posts = ($posts->isEmpty()) ? null : $posts;

       $new_articles = POST::select('title','slug')->orderBy('created_at','desc')->take(7)->get();

       return view('blog.search-result',['posts'=>$posts ,'new_articles'=>$new_articles]);
    }
}
