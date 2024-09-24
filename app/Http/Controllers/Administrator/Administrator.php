<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Administrator extends Controller
{
    public  function index() {
        $data = [
            'title' => 'Administrator'
         ];
         return view('Administrator/Dashboard/Data/file',$data);
    }

    public function menu_management ()  {
        $data = [
            'title' => 'Menu Management'
         ];
         return view('Administrator/Menu-management/Data/file',$data);
    }
}
