<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function postView()
    {
        return $this->hasMany('App\PostView');
    }
    public function postLikes()
    {
        return $this->hasMany('App\PostLike','post_id');
    }
}
