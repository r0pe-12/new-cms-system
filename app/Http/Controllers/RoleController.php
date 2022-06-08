<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    //
//    display all roles
    public function index(){
        # code
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

//    storing roles
    public function store(Request $request){
        # code
        $this->validate($request, [
           'name'=>'required'
        ]);

       $role = Role::create([
            'name'=>ucwords($request['name']),
            'slug'=>strtolower(str_replace(' ', '-', $request['name']))
        ]);

//       Auth::user()->roles()->attach($role);
       session()->flash('role-created', 'Role ' . '"' . $request['name'] . '"' . ' successfully created');
       return back();
    }

//    showing role edit form
    public function edit(Role $role){

        # code
        $permissions = Permission::paginate(10);
//        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

//    updating a role
    public function update(Request $request, Role $role){
        # code
        $this->validate($request, [
            'name'=>'required',
        ]);

        $role->name = ucwords($request['name']);
         $role->slug = strtolower(str_replace(' ', '-', $request['name']));
//            'slug'=>strtolower(\Str::of($request['name'])->slug('-'))

        if ($role->isClean('name')){
            session()->flash('role-clean', 'Nothing to update');
            return back();
        }
        $role->save();
        session()->flash('role-updated', 'Role ' . '"' . $role->name . '"' . ' successfully updated');
        return redirect()->route('role.index');
    }

//    deleting roles
    public function destroy(Role $role){
        # code
        $role->delete();
        session()->flash('role-deleted', 'Role ' . '"' . $role->name . '"' . ' successfully deleted');
        return back();
    }

//    attaching roles
    public function attach(Role $role, Permission $permission){
        # code
        if ($role->hasPermission($permission->slug)){
            session()->flash('role-permission-attached', 'Permission ' . $permission->name . ' ALREADY attached to role ' . $role->name);
            return back();
        }
        $role->permissions()->attach($permission);
        session()->flash('role-permission-attached', 'Permission ' . $permission->name . ' successfully attached to role ' . $role->name);
        return back();
    }

//    detaching roles
    public function detach(Role $role, Permission $permission){
        # code
        if (!$role->hasPermission($permission->slug)){
            session()->flash('role-permission-detached', 'Permission ' . $permission->name . ' ALREADY detached from role ' . $role->name);
            return back();
        }
        $role->permissions()->detach($permission);
        session()->flash('role-permission-detached', 'Permission ' . $permission->name . ' successfully detached from role ' . $role->name);
        return back();
    }

}
