<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->withUsers($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-user'))
        {
            return redirect()->route('users.index');
        }
        $roles = Role::all();
        return view('users.edit')->with([
            'user'  => $user , 
            'roles' => $roles 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /**
         * sync is like attach but it needs array 
         * attach need one value (one id for example)
         * in our case we are passing array of id roles
         */
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        session()->flash('success','Saved Changes Successfully :)');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-user'))
        {
            return redirect()->route('users.index');
        }
        $user->roles()->detach();
        $user->delete();
        session()->flash('success','User Deleted Successfully :)');
        return redirect()->route('users.index');
    }
}
