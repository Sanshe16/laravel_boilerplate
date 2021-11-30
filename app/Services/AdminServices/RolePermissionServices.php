<?php


namespace App\Services\AdminServices;


use Illuminate\Support\Facades\Route;

class RolePermissionServices
{

    public function rolePermissions($role){

        $routes = Route::getRoutes();

        $actions = [];
        foreach ($routes as $route) {
//            if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
            if ($route->getName() != "") {
                $actions[] = $route->getName();
            }
        }

        //remove hide option
        $input = preg_quote("hide", '~');
        $var = preg_grep('~' . $input . '~', $actions);
        $actions = array_values(array_diff($actions, $var));

        $var = [];
        //$i = 0;
        foreach ($actions as $key => $action) {
            $input = preg_quote(explode('.', $action )[0].".", '~');
            $var[$key] = preg_grep('~^' . $input . '~', $actions);
            $actions = array_values(array_diff($actions, $var[$key]));
        }
        $actions = array_filter($var);
        $rolesPermissions = json_decode($role->permissions,true);

        return View('backend.content.admin.user_management.roles.permissions', compact('role', 'actions','rolesPermissions'))
            ->with('breadcrumbs','Sa.Show.Roles.Permissions')
            ->with('b_id',$role->id);
    }

    public function rolePermissionsStore($request,$role){

        if(empty($request->except('_token'))) {
            toastr()->warning('Almost one permission select','LimeTank Says');
            return back();
        }
        $role->permissions = [];
        $permissions = array();
        foreach ($request->permissions as $permission=>$value) {
            //if (!array_key_exists($permissions,$value)){
            $permissions = array_merge($permissions,[$value=>true]);
            //}
        }
        $role->permissions = json_encode($permissions);
        $role->save();
        return redirect(route('roles.index'))->with('success','Permission Synced Successfully');
    }
}
