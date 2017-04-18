<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Users;
use App\Permissions;
use App\PermissionUser;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('auth/login');
            }
        }

        $user = Auth::user();
        $currentPath= Route::getCurrentRoute()->getName();
        
        $rows = new Permissions();

        $getCurrentPermissions = Permissions::where('slug','LIKE',$currentPath)->select('id')->get();
        $arrPermissions = json_decode($user->permissions);

        if($user->id != 1){
            if(count($getCurrentPermissions) <= 0 || $arrPermissions == NULL || (!in_array($getCurrentPermissions[0]->id, $arrPermissions))){
                return redirect('system/denied');
            }
        }

        return $next($request);
    }
}
