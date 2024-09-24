<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Auth\Auth;
use App\Http\Controllers\Administrator\Administrator;
use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\User\User;
use App\Http\Controllers\Others\Others;
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
Route::get('/Administrator/List-menu', [Administrator::class, 'menu_management'])->name('menu.view');



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