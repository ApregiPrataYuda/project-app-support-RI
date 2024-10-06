<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        // Tentukan waktu maksimal sesi (misalnya 1 jam)
        $timeout = 3600; // dalam detik (1 jam)
        // $timeout = 120; // dalam detik (1 jam)

        $lastActivity = session('lastActivityTime');
        $currentTime = time();

        // Jika waktu inaktivitas sudah lebih dari $timeout, logout pengguna
        if ($lastActivity && ($currentTime - $lastActivity) > $timeout) {
            Auth::logout(); // Logout pengguna
            session()->flush(); // Bersihkan session
            return redirect('/Login')->with('message', 'Sesi Anda telah habis, silakan login kembali.');
        }

        // Perbarui last activity time
        session(['lastActivityTime' => $currentTime]);

        return $next($request);
    }
}