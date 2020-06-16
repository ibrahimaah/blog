<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class PostView extends Model
{

    protected $table = 'post_views';
    
    public static function createViewLog($post)
    {
        $postview = new PostView();

        $postview->post_id    = $post->id;
        $postview->titleslug  = $post->slug;
        $postview->url        = request()->url();
        $postview->session_id = request()->getSession()->getId();
        $postview->user_id    = (Auth::check()) ? Auth::id() : null;
        $postview->ip         = request()->ip();
        $postview->agent      = request()->header('User-Agent');

        $postview->save();
    }

    public function post()
    {
       return $this->belongsTo('App\Post');
    }

}
