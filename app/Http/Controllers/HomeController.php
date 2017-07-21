<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;

class HomeController extends Controller {

    /**
     * Attach role to the user
     *
     * @param Integer $userId
     * @param String $role
     * @return void
     */ 
    public function attachUserRole($userId, $role){
        $user = User::find($userId);
        $roleId = Role::where('name', $role)->first();
        $user->roles()->attach($roleId);
        return response()->json(['user' => $user], 200);
    }

    /**
     * Get the role of the user
     *
     * @param Integer $userId
     * @return role
     */
    public function getUserRole($userId){
        $user = User::find($userId);
        return $user->roles;
    }

    /**
     * Attach a permission to a role
     *
     * @param Request $request
     * @return permission
     */ 
    public function attachPermission(Request $request){
        $params = $request->only('permission', 'role');

        $permission_name = $params['permission'];
        $role_name = $params['role'];

        $role = Role::where('name', $role_name)->first();
        $permission = Permission::where('name', $permission_name)->first();

        $role->attachPermission($permission);

        return $role->permission;
    }

    /**
     * Check if the user has the permission
     *
     * @param Integer $user_id
     * @return Json
     */
    public function checkPermission($user_id, $permission){
        $user = User::find($user_id);

        if($user->can($permission)) {
            return response()->json(['Can' => 'true']);
        } else {
            return response()->json(['Can' => 'false']);
        }
    }

}
