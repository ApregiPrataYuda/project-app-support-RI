<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Periksa apakah session 'user_id' ada
        if (!Session::has('user_id')) {
            // Jika tidak ada, redirect ke halaman login atau halaman lain
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Jika ada session, teruskan request
        return $next($request);
    }
}
