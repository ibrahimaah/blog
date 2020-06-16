<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //every category may has alot of posts
    //so it is one-to-many relation
    //we have to define it
    //note: one-to-one = one-to-many
    public function posts()//function name is a convention
    {
        return $this->hasMany('App\Post');//now laravel knows that category_id is foreign key
    }
}
