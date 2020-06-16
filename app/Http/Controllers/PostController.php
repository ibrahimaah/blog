<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Auth;
use Image;

class PostController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
  
    public function index()
    {
        //POST:: i.e select(*) from posts
        $posts = POST::orderBy('id','desc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create post form
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //first of all we have to validate the form fields
        //$request->falsh();
        /**
         * dd function is for debugging
         */
        //dd($request);
        /**
         * sometimes is opposite of required
         */
        $request->validate([
            'title'      => 'required|max:255', 
            'body'       => 'required',
            'post_img'       => 'sometimes|image',
            'category_id'=> 'required|integer',
            'slug'       => 'required|alpha_dash|min:5|max:255|unique:posts'
        ]);
        //if error happened in the previous validation then it will be redirected to create action
        

        $post = new Post();
        $post->title        = $request->title;
        $post->body         = $request->body;
        $post->slug         = $request->slug;
        $post->category_id  = $request->category_id;
        $post->user_id      = Auth::user()->id;
        /**
         * uploading img by the user is not required
         * so we have to check if he uploaded an img
         * or not
         */
        if($request->hasFile('post_img'))
        {
            $post_img = $request->file('post_img');
            /* 
               u can write this  $img_name = time().'.'.encode('png') so u can 
               convert any uploaded image to png
               getClientOriginalExtension() function is from Image Intervention Library
            */
            $img_name = time().'.'. $post_img->getClientOriginalExtension();
            /**
             * asset('') get URL not path
             * asset() get URL to the public folder
             * if u want to save your image inside storage folder u have to
             * write this : storage_path()
             * The difference between storage and public that u can not get the
             * images inside the storage folder using URL cause they are protected
            */
            $img_storage_location = public_path('img/'.$img_name);
            /**
             * Image::make($post_img) create img object
             * it is a good idea to resize the image by the server side
             */
            Image::make($post_img)->resize(800,400)->save($img_storage_location);

            $post->img = $img_name;
        }

        $post->save();
        /**
         * The following line of code is specific for inserting in
         * post-tag table , tags() is a method of class model Post
         * sync is function to associate(id post -which already known from $post obj-)
         * with (ids of tag table which are array in the request obj) ,
         * false means (adding) not (removing then adding)
         */
        $post->tags()->sync($request->tags,false);
        
        session()->flash('success','The Post is Created Successfully :)');
        //return redirect('posts.show')->with($post->id);
        /*
         The route 'posts.show' fire the action show
         (if there is not validation errors) 
         */
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        //return view('posts.show',[ 'post' => $post ]); OR
        //return view('posts.show')->with('post',$post); OR
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {

        $post = POST::findOrFail($id);
        

        $categories=Category::all();
        $arr_categories=[];
        foreach($categories as $category)
        {
            $arr_categories[$category->id]=$category->name;
        }

        $tags =Tag::all();
        $arr_tags =[];
        foreach($tags as $tag)
        {
            $arr_tags[$tag->id]=$tag->name;
        }
        //dd($arr_tags);
        return view('posts.edit')->withPost($post)->withCategories($arr_categories)->withTags($arr_tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $post = POST::findOrFail($id);
        
       /**
        * if statement because we get forced to edit slug cause
        * the column slug is unique
        */
        
        if($post->slug == $request->slug)
        {
            $request->validate([
                'title'       => 'required|max:255|min:5',
                'body'        => 'required',
                'slug'        => 'required|alpha_dash|min:5|max:255',
                'category_id' => 'required|integer',
                'post_img'    => 'sometimes|image'
            ]); 
        }
        else{
            $request->validate([
            'title'       => 'required|max:255|min:5',
            'body'        => 'required',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts',
            'category_id' => 'required|integer',
            'post_img'    => 'sometimes|image'
        ]);
        }
        
        if($request->hasFile('post_img'))
        {
            $post_img = $request->file('post_img');
            $img_name = time().'.'. $post_img->getClientOriginalExtension();
            $img_storage_location = public_path('img/'.$img_name);
            Image::make($post_img)->resize(800,400)->save($img_storage_location);
            //we have to grab the old image name to delete it
            if(isset($post->img)){
                $old_img = $post->img;
                $old_img_path = public_path('img/'.$old_img);
                unlink($old_img_path);
            }
            $post->img = $img_name;
        }

        $post->slug = $request->slug;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags,true);
        
        session()->flash('success_update' , 'Post Updated Successfully :)');
        
        return redirect()->route('posts.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = POST::findOrFail($id);
        //delete tag_id related to this post from the pivot table
        //u can delete using migrations (cascade)
        $post->tags()->detach();
        $old_img = $post->img;
        $old_img_path = public_path('img/'.$old_img);
        unlink($old_img_path);
        $post->delete();
        session()->flash('success_delete','Post Deleted Successfully :)');
        return redirect()->route('posts.index');
    }
}
