<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public  function index() {
        $data = [
            'title' => 'Dashboard User'
         ];
         return view('User/Dashboard/Data/file',$data);
   }
}
