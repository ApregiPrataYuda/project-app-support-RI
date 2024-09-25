<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = Auth::user();
        $getRole = session()->get('role_id');
        $menu = $request->segment(1); // Mengambil segmen pertama dari URL
        // dd($menu);
        if (!$getRole) {
            return redirect('/');
        }
        // Query untuk mendapatkan menu
        $menuData = DB::table('ms_menu')->where('menu', $menu)->first();

        if (!$menuData) {
            return redirect('/block');
        }
        $menuId = $menuData->id;
        // $roleId = $user->role_id;
        $roleId = $getRole;
        // Query untuk mendapatkan akses user
        $userAccess = DB::table('ms_user_access_menu')
                       ->where(['role_id' => $roleId, 'menu_id' => $menuId])
                       ->exists();
        if (!$userAccess) {
            return redirect('/block');
        }
        return $next($request);
    }
}
