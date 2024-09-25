<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class CheckSubmenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Mendapatkan ID pengguna dari sesi
        // $user_id = Auth::id(); // Menggunakan Auth::id() jika menggunakan sistem autentikasi
        $user_id = session()->get('user_id'); 
        // Mendapatkan segmen URL
        $segments = $request->segments();
        $menu = $segments[0] ?? '';
        $submenu = $segments[1] ?? '';
        $gabungan = $menu . '/' . $submenu;

        // Query untuk mendapatkan submenu
        $querysubmenu = DB::table('ms_sub_menu')
            ->where('url', $gabungan)
            ->first();

        if (!$querysubmenu) {
            return Redirect::to('/block');
        }

        $submenuid = $querysubmenu->id;

        // Query untuk memeriksa akses pengguna ke submenu
        $useraccesssubmenu = DB::table('ms_user_accesssubmenu')
            ->where('userid', $user_id)
            ->where('submenuid', $submenuid)
            ->exists();

        if (!$useraccesssubmenu) {
            return Redirect::to('/block');
        }

        return $next($request);
    }
}
