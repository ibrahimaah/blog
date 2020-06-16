<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'likes';
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo('App\Post','post_id');
    }

    public static function count_likes($post_id)
    {
        $num_of_likes = PostLike::where('post_id',$post_id)->where('like_post','1')->count();
        return $num_of_likes;
    }

    public static function count_dislikes($post_id)
    {
        $num_of_dislikes = PostLike::where('post_id',$post_id)->where('like_post','0')->count();
        return $num_of_dislikes;
    }
}
