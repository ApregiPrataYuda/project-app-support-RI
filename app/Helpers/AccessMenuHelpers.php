<?php 
// app/Helpers/AccessHelper.php
use Illuminate\Support\Facades\DB;

if (!function_exists('cek_akses')) {
    function cek_akses($role_id, $menu_id)
    {
        // Query untuk mengecek akses
        $exists = DB::table('ms_user_access_menu')
                    ->where('role_id', $role_id)
                    ->where('menu_id', $menu_id)
                    ->exists();

        // Cek hasil query
        if ($exists) {
            return "checked='checked'";
        }
        return ""; // Tambahkan return default jika tidak ditemukan
    }
}
