<?php
use Illuminate\Support\Facades\DB;
// Mendapatkan role_id dari session
$role_id = session()->get('role_id');

// Melakukan query menggunakan query builder
$menu = DB::table('ms_menu AS A')
    ->leftJoin('ms_user_access_menu AS B', 'A.id', '=', 'B.menu_id')
    ->where('B.role_id', $role_id)
    ->orderBy('B.menu_id', 'asc')
    ->select('A.id', 'A.menu')
    ->get();
 ?>
 

@foreach ($menu as $m)
        <li style="font-style: bold; font-size: bold; color: RGB(245, 245, 245);" class="nav-header">{{ $m->menu }}</li>
  <?php 
 $menuId = $m->id;
 $user_id = session()->get('user_id');
 $submenu = DB::table('ms_user_accesssubmenu AS A')
            ->leftJoin('ms_user AS B', 'A.userid', '=', 'B.user_id')
            ->leftJoin('ms_sub_menu AS C', 'A.submenuid', '=', 'C.id')
            ->where('A.userid', $user_id)
            ->where('C.menu_id', $menuId)
            ->where('C.is_active', 1)
            ->orderBy('C.title', 'asc')
            ->select('C.title', 'C.url', 'C.icon')
            ->get();
  ?>
        @foreach ($submenu as $sm)
            <li class="nav-item">
                <a style="color: RGB(206, 207, 198);" href="{{ url($sm->url) }}" class="nav-link">
                    <i class="{{ $sm->icon }}"></i>
                    <p style="color: RGB(245, 245, 245);" class="text-capitalize">
                        {{ $sm->title }}
                    </p>
                </a>
            </li>
        @endforeach
@endforeach

