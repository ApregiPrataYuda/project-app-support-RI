<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class Auth extends Controller
{
     protected $AuthModel;
    public function __construct(AuthModel $AuthModel) {
        $this->AuthModel = $AuthModel;
    }


    public function views()  {
        $data  = [
            'title' => 'Page Login'
         ];
         return view('authentikasi/login',$data);
    }


    public function login_store(Request $request) {

        $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
        ]);


          // Ambil data dari input request
    $username = $request->input('username');
    $password = $request->input('password');


       // Cari pengguna berdasarkan username
    $user = $this->AuthModel->where('username', $username)->first();
    if ($user) {
        $check = $user && Hash::check($password, $user->password);
    if ($check) {
            $checkAktif =  $user->is_active;
            if ($checkAktif === 1) {
            $checkrole =  $user->role_id;
             if ($checkrole === 1) {

                $sess = [
                    'user_id' => $user['user_id'],
                    'fullname' => $user['fullname'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                ];
                session()->put($sess);
                return redirect()->to('Administrator/DashboardIT');


             }elseif ($checkrole === 2) {
                $sess = [
                    'user_id' => $user['user_id'],
                    'fullname' => $user['fullname'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                ];
                session()->put($sess);
                return redirect()->to('Admin/Dashboard-Admin');

             }else {
                $sess = [
                   'user_id' => $user['user_id'],
                    'fullname' => $user['fullname'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                ];
                session()->put($sess);
                return redirect()->to('User/Dashboard-User');
             }
    }else {
            return redirect()->back()->withErrors([
                'Chekstatus' => 'AKUN anda Nonaktif.',
                ]);
           }
    }else {

            return redirect()->back()->withErrors([
                'ChekaMatch' => 'Password Salah.',
                ]);
            }
    }else{
                return redirect()->back()->withErrors([
                'checkUsername' => 'Username Tidak Ada.',
                ]);
    }

    }

    public function logout()
{
    // Auth::logout();
    // return redirect('/'); // Ganti dengan rute yang sesuai setelah logout
    Auth::logout();
    Session::flush(); // Menghapus semua data session
    return redirect('/login');
}
}
