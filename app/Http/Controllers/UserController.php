<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function show(User $user){
        # code
        return view('admin.users.profile', ['user'=>$user]);
    }

//    updating user details
    public function update(User $user, Request $request){
        # code
        $input = $this->validate($request, [
           'username'=>'required|string|max:255|alpha_dash',
           'name'=>'required|string|max:255',
           'email'=>'required|email|max:255',
           'avatar'=>'file',
           'password'=>'confirmed'
        ]);
        if (!$input['password']){
            unset($input['password']);
        }
//        dd($input);
        if ($request->file('avatar')){
            $input['avatar'] = $request->file('avatar')->store('images');
        }
        $user->update($input);
        return back();
    }
}
