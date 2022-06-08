<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //

//    displaying all permissions
    public function index(){
        # code
        $permissions = Permission::paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }


//    storing permissions
    public function store(Request $request){
        # code

        $this->validate($request, [
            'name'=>'required'
        ]);

        $permission = Permission::create([
            'name'=>ucwords($request['name']),
            'slug'=>strtolower(str_replace(' ', '-', $request['name']))
        ]);

        session()->flash('permission-created', 'Permission ' . '"' . $request['name'] . '"' . ' successfully created');
        return back();
    }

    //    showing role edit form
    public function edit(Permission $permission){

        # code
        return view('admin.permissions.edit', compact('permission'));
    }

    //    updating a permission
    public function update(Request $request, Permission $permission){
        # code
        $this->validate($request, [
            'name'=>'required',
        ]);

        $permission->name = ucwords($request['name']);
        $permission->slug = strtolower(str_replace(' ', '-', $request['name']));
//            'slug'=>strtolower(\Str::of($request['name'])->slug('-'))

        if ($permission->isClean('name')){
            session()->flash('permission-clean', 'Nothing to update');
            return back();
        }
        $permission->save();
        session()->flash('permission-updated', 'Permission ' . '"' . $permission->name . '"' . ' successfully updated');
        return redirect()->route('permission.index');
    }

    //    deleting permissions
    public function destroy(Permission $permission){
        # code
        $permission->delete();
        session()->flash('permission-deleted', 'Permission ' . '"' . $permission->name . '"' . ' successfully deleted');
        return back();
    }
}
