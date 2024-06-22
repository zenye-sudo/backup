<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
class UsersController extends Controller
{
    public function index(){
        $users=User::all();
       return view('backend.users.index',compact('users'));
    }
    public function edit($id){
        $user=User::whereId($id)->firstOrFail();
        $roles=Role::all();
        $rolesSelected=$user->roles->pluck('name')->toArray();
        return view('backend.users.edit',compact("user","roles","rolesSelected"));
    }
    public function update(Request $request,$id){
        $user=User::whereId($id)->firstOrFail();
        $user->syncRoles($request->get('roles'));
        return redirect(action('admin\UsersController@edit',$id))->with('status',"Update successful");
    }
}
