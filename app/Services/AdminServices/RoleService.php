<?php


namespace App\Services\AdminServices;


use App\Models\Role;
use Yajra\DataTables\DataTables;

class RoleService
{

    public function roleList(){
        $roles = Role::query();
        return DataTables::of($roles)->only(['id','name'])->toJson();
    }

    public function rolesAttachedUsers($role){
        $users = $role->select('id','name')->with('users')->get();
        return DataTables::of($users)->only(['id','name'])->toJson();
    }

    public function roleStore($request){
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->permissions = json_encode([]);
        return $role->save();
    }

    public function viewRoles($role){

            return DataTables::of($role->users)
                ->addColumn('name', function ($users) {
                    return $users->name;
                })->addColumn('email', function ($users) {
                    return $users->email;
                })->toJson();

    }


    public function roleUpdate($request,$id){
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
    }

    public function attachRoleToUserCreate(){
        $roles = Role::select('id','name')->get();
        return view('backend.content.admin.user_management.roles.attach',['roles'=>$roles]);
    }

    public function attachRoleToUserStore($request,$user){
        $user->roles()->attach($request->role);
        return  redirect()->route('users.index')->with('success','Role Attached Successfully');
    }

    public function findRole($id){
        return Role::findorFail($id);
    }

}
