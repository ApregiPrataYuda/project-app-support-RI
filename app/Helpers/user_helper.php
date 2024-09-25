<?php

use Illuminate\Support\Facades\Session;
use App\Models\UserModel;
use App\Helpers\UserHelper;
if (! function_exists('getUserData')) {
    /**
     * Get user data from session.
     *
     * @return \App\Models\UserModel|null
     */
    function getUserData()
    {
        // Mendapatkan ID pengguna dari sesi
        // $userId = Session::get('user_id');
        // if ($userId) {
        //     // Menemukan model User berdasarkan ID
        //     return UserModel::find($userId);
        // }
        // return null;

         // Mendapatkan ID pengguna dari sesi
         $userId = Session::get('user_id');
         if ($userId) {
             // Menemukan model User berdasarkan ID, dan juga mengambil relasi employee
             return UserModel::with('employee')->find($userId);
         }
         return null;
    }
}
