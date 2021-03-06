<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
//    displaying all users
    public function index(){
        # code
        $users = User::paginate(10);
//        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    public function show(User $user){
        # code
//        dd($this->authorize('view', $user));
        $roles = Role::all();
        return view('admin.users.profile', ['user'=>$user, 'roles'=>$roles]);
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
        session()->flash('user-updated', 'Successfully updated user info');
        return back();
        }

//        deleting a user
    public function destroy(User $user){
        # code
        $user->delete();
        session()->flash('user-deleted', 'User ' . $user->username . ' was deleted successfully');
//        dd(session('user-deleted'));
//        dd(session());
        return back();
    }

//    Attaching a role to a user
    public function attach(User $user, Role $role){
        # code
        if ($user->hasRole($role->slug)){
            session()->flash('user-role-attached', 'Role ' . '"' . $role->name . '"' . ' ALREADY attached to user ' . $user->username . ' (' . $user->name . ')');
            return back();
        }

        $user->roles()->attach($role);
        session()->flash('user-role-attached', 'Role ' . '"' . $role->name . '"' . ' successfully attached to user ' . $user->username . ' (' . $user->name . ')');
        return back();
    }

//    Detaching role from user
    public function detach(User $user, Role $role){
        # code
        if (!$user->hasRole($role->slug)){
            session()->flash('user-role-detached', 'Role ' . '"' . $role->name . '"' . ' ALREADY detached from user ' . $user->username . ' (' . $user->name . ')');
            return back();
        }

        $user->roles()->detach($role);
        session()->flash('user-role-detached', 'Role ' . '"' . $role->name . '"' . ' successfully detached from user ' . $user->username . ' (' . $user->name . ')');
        return back();
    }
}
