<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Others extends Controller
{
    public function logout()
    {
        // Auth::logout();
        // return redirect('/'); // Ganti dengan rute yang sesuai setelah logout
        Auth::logout();
        Session::flush(); // Menghapus semua data session
        return redirect('/');
    }

}
