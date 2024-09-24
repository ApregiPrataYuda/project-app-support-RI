<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('cek_akses_submenu')) {
    /**
     * Cek apakah akses submenu diizinkan untuk user tertentu.
     *
     * @param int $user_id
     * @param int $submenu_id
     * @return string
     */
    function cek_akses_submenu($user_id, $submenu_id)
    {
        // Menggunakan Query Builder Laravel
        $count = DB::table('ms_user_accesssubmenu')
                    ->where('userid', $user_id)
                    ->where('submenuid', $submenu_id)
                    ->count();

        // Cek hasil query
        if ($count > 0) {
            return "checked='checked'";
        }

        return ""; // Tambahkan return default jika tidak ditemukan
    }
}
