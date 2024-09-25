<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Auth\Auth;
use App\Http\Controllers\Administrator\Administrator;
use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\User\User;
use App\Http\Controllers\Others\Others;
use App\Http\Middleware\CheckMenuAccess;
use App\Http\Middleware\CheckSubmenuAccess;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/block', function () {
    return view('Err/block');
});


Route::get('/', [Home::class, 'About'])->name('about');
Route::get('/Home/Form-visitor', [Home::class, 'Form_visitor'])->name('form.visitor');
Route::post('/Home/submission-send', [Home::class, 'store_data_visit_submission'])->name('submission.store');

Route::get('/Home/Management-Borrow-Item', [Home::class, 'view_borrow_management'])->name('borrow.management');

Route::get('/Home/Announcement', [Home::class, 'Announcement'])->name('Announcement.index');

Route::get('/Home/Check-paket', [Home::class, 'check_paket'])->name('check.paket');
Route::get('/Home/List-paket', [Home::class, 'list_pakets'])->name('lists.paket');
Route::post('/Home/get-paket-user', [Home::class, 'ambil_paket'])->name('get.paket.user');


Route::get('/Login', [Auth::class, 'views'])->name('login');
Route::post('/Login-action', [Auth::class, 'login_store'])->name('login.store');
Route::get('/logout', [Auth::class, 'logout'])->name('logout');


Route::get('/Administrator/DashboardIT', [Administrator::class, 'index'])->name('Administrator');

Route::get('/Administrator/List-menu', [Administrator::class, 'menu_management'])->name('menu.view')->middleware('check.session')->middleware(CheckMenuAccess::class)->middleware(CheckSubmenuAccess::class);
Route::get('/Administrator/get-menu', [Administrator::class, 'get_menu_data'])->name('get.menu');
Route::get('/Administrator/create-menu', [Administrator::class, 'create_menu'])->name('menu.create');
Route::post('/Administrator/store-menu', [Administrator::class, 'store_menu'])->name('store.menu');
Route::get('/Administrator/views-menu-update/{id}', [Administrator::class, 'view_menu_update'])->name('menu.view.update');
Route::put('/Administrator/update-menu/{id}', [Administrator::class, 'update_menu'])->name('update.menu');
Route::delete('/Administrator/delete-menu/{id}', [Administrator::class, 'destroy_menu'])->name('delete.menu');
Route::get('/Administrator/restore-data-menu', [Administrator::class, 'restore_menu'])->name('restore.data.menu');
Route::get('/Administrator/get-data-menu-restore', [Administrator::class, 'get_menu_data_restore'])->name('get.menu.restore.data');
Route::post('/Administrator/restore-menu/{id}', [Administrator::class, 'restore'])->name('restore.menu');
Route::delete('/Administrator/delete-menu-permanent/{id}', [Administrator::class, 'destroy_menu_permanent'])->name('delete.menu.permanent');

Route::get('/Administrator/List-submenu', [Administrator::class, 'submenu_management'])->name('submenu.view');
Route::get('/Administrator/get-submenu', [Administrator::class, 'get_submenu_data'])->name('get.submenu');
Route::get('/Administrator/Create-submenu', [Administrator::class, 'create_submenu'])->name('create.submenu');
Route::post('/Administrator/Store-submenu', [Administrator::class, 'store_submenu'])->name('store.submenu');
Route::get('/Administrator/view-submenu-update/{id}', [Administrator::class, 'view_submenu_update'])->name('submenu.view.update');
Route::put('/Administrator/update-submenu/{id}', [Administrator::class, 'update_submenu'])->name('update.submenu');
Route::delete('/Administrator/delete-submenu/{id}', [Administrator::class, 'destroy_submenu'])->name('delete.submenu');
Route::get('/Administrator/restore-data-submenu', [Administrator::class, 'restore_submenu'])->name('restore.data.submenu');
Route::get('/Administrator/get-data-submenu-restore', [Administrator::class, 'get_submenu_data_restore'])->name('get.submenu.restore.data');
Route::post('/Administrator/restore-submenu/{id}', [Administrator::class, 'restore_submenu_data'])->name('restore.submenu');
Route::delete('/Administrator/delete-submenu-permanent/{id}', [Administrator::class, 'destroy_submenu_permanent'])->name('delete.submenu.permanent');


Route::get('/Administrator/Management-role', [Administrator::class, 'Role_management'])->name('role.index');
Route::get('/Administrator/get-role', [Administrator::class, 'get_role_data'])->name('get.role');
Route::get('/Administrator/create-role', [Administrator::class, 'create_role'])->name('role.create');
Route::post('/Administrator/store-role', [Administrator::class, 'store_role'])->name('store.role');
Route::get('/Administrator/view-role/{id}', [Administrator::class, 'view_role'])->name('role.view');
Route::put('/Administrator/update-role/{id}', [Administrator::class, 'update_role'])->name('update.role');
Route::delete('/Administrator/delete-role/{id}', [Administrator::class, 'destroy_role'])->name('delete.role');
Route::get('/Administrator/restore-data-role', [Administrator::class, 'restore_role'])->name('restore.data.role');
Route::get('/Administrator/get-data-role-restore', [Administrator::class, 'get_role_data_restore'])->name('get.role.restore.data');
Route::post('/Administrator/restore-role/{id}', [Administrator::class, 'restore_role_data'])->name('restore.role');
Route::delete('/Administrator/delete-role-permanent/{id}', [Administrator::class, 'destroy_role_permanent'])->name('delete.role.permanent');
Route::get('/Administrator/access-menu/{id}', [Administrator::class, 'access_menu'])->name('menu.access');
Route::post('/change-access-menu', [Administrator::class, 'ubahAccessmenu'])->name('change.access.menu');



Route::get('/Administrator/Management-user', [Administrator::class, 'Manajemen_pengguna'])->name('user.index');
Route::get('/Administrator/get-user', [Administrator::class, 'get_user_data'])->name('get.user');
Route::get('/Administrator/create-user', [Administrator::class, 'create_user'])->name('user.create');
Route::post('/Administrator/store-user', [Administrator::class, 'store_user'])->name('store.user');
Route::get('/Administrator/edit-user/{id}', [Administrator::class, 'edit_user'])->name('user.edit');
Route::put('/update-user/{id}', [Administrator::class, 'update_user'])->name('update.user');
Route::delete('/Administrator/delete-user/{id}', [Administrator::class, 'destroy_user'])->name('delete.user');
Route::get('/Administrator/access-user/{id}', [Administrator::class, 'access_user'])->name('user.access');
Route::post('change-access', [Administrator::class, 'ubahAccesssubmenu'])->name('change.access');






Route::get('/Admin/Dashboard-Admin', [Admin::class, 'index'])->name('Admin');
Route::get('/Admin/Data-visitors', [Admin::class, 'visitors'])->name('Admin.visitors');
Route::get('/Admin/get-visitor', [Admin::class, 'get_visitor_data'])->name('get.visitor');
Route::get('/Admin/Idcard-visitor/{id}', [Admin::class, 'idcard_visitor_data'])->name('idcard.visitor');
Route::get('/Admin/Idcard-visitor-print/{id}', [Admin::class, 'idcard_visitor_data_print'])->name('idcard.visitor.print');
Route::get('/Admin/Add-visitor', [Admin::class, 'Add_visitor'])->name('add.visitor');


Route::get('/Admin/List-Paket', [Admin::class, 'daftar_paket'])->name('Admin.paket');
Route::get('/Admin/get-paket', [Admin::class, 'get_paket_data'])->name('get.paket');
Route::get('/Admin/Add-paket', [Admin::class,'add_paket'])->name('add.paket');
Route::post('/Admin/store-paket', [Admin::class,'store_paket'])->name('store.paket');
Route::get('/Admin/view-data-paket/{id}', [Admin::class, 'view_data_paket'])->name('paket.view.data');
Route::put('/Admin/update-paket/{id}', [Admin::class, 'update_paket'])->name('update.paket');
Route::delete('/Admin/delete-paket/{id}', [Admin::class, 'destroy_paket'])->name('delete.paket');

Route::get('/User/Dashboard-User', [User::class, 'index'])->name('User');



Route::get('/Others/Logout', [Others::class, 'logout'])->name('logout');