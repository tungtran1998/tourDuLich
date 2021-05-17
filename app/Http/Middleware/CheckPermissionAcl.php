<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;


class CheckPermissionAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $listRoleOfUser = DB::table('admins')
            ->join('role_admin', 'admins.id', '=', 'role_admin.admin_id')
            ->join('roles', 'role_admin.role_id', '=', 'roles.id')
            ->where('admins.id',auth()->id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();

        $listRoleOfUser = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id',$listRoleOfUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();

        $checkPermisson = Permission::where('name',$permission)->value('id'); 
        
        if ($listRoleOfUser->contains($checkPermisson)) {
            return $next($request);
        }
        return abort(401);
        
        
        
    }
}
