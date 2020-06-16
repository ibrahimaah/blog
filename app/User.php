<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    //we need these functions to use them in gates at Providers/AuthServiceProvider
    public function fun_has_any_roles($roles)
    {
        if($this->roles()->whereIn('role_name',$roles)->first())
        {
            return true;
        }
        return false;
    }
    public function fun_has_role($role)
    {
        if($this->roles()->where('role_name',$role)->first())
        {
            return true;
        }
        return false;
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
