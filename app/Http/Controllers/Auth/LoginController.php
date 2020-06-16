<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
//use App\User; //////////////////////////////////////////

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
     protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function redirectTo()
    {
        /*if(Auth::user()->fun_has_role('admin'))
        {
            return $this->redirectTo=route('posts.index');
        }*/
        /*elseif(Auth::user()->fun_has_role('author')){
            return $this->redirectTo=route('posts.index');
        }*/
        
        /*return $this->redirectTo=route('home'); */
    }
    //Login Via Facebook Api
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return $this->redirectTo=route('home'); ////////////////////////////
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id]);
                $newUser->save();//////////////////////
                Auth::login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/facebook');
        }
    }
}
