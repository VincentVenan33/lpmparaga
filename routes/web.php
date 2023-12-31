<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

$currentRoute = Route::currentRouteName();

//dashboard
Route::get('/', [HomeController::class, 'readers'])->name('index');
Route::get('admin/dashboard', [HomeController::class, 'home'])->name('dashboard')->middleware('auth');
//login
Route::get('admin/login', function () {
    $data = array();
    $data['title'] = "Login";
    return view('login', $data);
})->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');
//users
Route::get('admin/users/view', [UsersController::class, 'viewusers'])->name('viewusers')->middleware('auth');
Route::get('admin/users/add', [UsersController::class, 'addusers'])->name('addusers')->middleware('auth');
Route::post('admin/users/save', [UsersController::class, 'saveusers'])->name('saveusers')->middleware('auth');
Route::get('admin/users/change/{id}', [UsersController::class, 'changeusers'])->name('changeusers')->middleware('auth');
Route::post('admin/users/update', [UsersController::class, 'updateusers'])->name('updateusers')->middleware('auth');
Route::get('admin/users/delete/{id}', [UsersController::class, 'deleteusers'])->name('deleteusers')->middleware('auth');
//anggota
Route::get('admin/anggota/view', [AnggotaController::class, 'viewanggota'])->name('viewanggota')->middleware('auth');
Route::get('admin/anggota/add', [AnggotaController::class, 'addanggota'])->name('addanggota')->middleware('auth');
Route::post('admin/anggota/save', [AnggotaController::class, 'saveanggota'])->name('saveanggota')->middleware('auth');
Route::get('admin/anggota/change/{id}', [AnggotaController::class, 'changeanggota'])->name('changeanggota')->middleware('auth');
Route::post('admin/anggota/update', [AnggotaController::class, 'updateanggota'])->name('updateanggota')->middleware('auth');
Route::get('admin/anggota/detail/{id}', [AnggotaController::class, 'detailanggota'])->name('detailanggota')->middleware('auth');
Route::get('admin/anggota/delete/{id}', [AnggotaController::class, 'deleteanggota'])->name('deleteanggota')->middleware('auth');
//profile
Route::get('admin/profile/change', [ProfilController::class, 'changeprofil'])->name('changeprofil')->middleware('auth');
Route::post('admin/profile/update', [ProfilController::class, 'updateprofile'])->name('updateprofile')->middleware('auth');
Route::get('admin/profile/delete', [ProfilController::class, 'deleteprofil'])->name('deleteprofil')->middleware('auth');
//news
Route::get('admin/news/view', [NewsController::class, 'viewnews'])->name('viewnews')->middleware('auth');
Route::get('admin/news/add', [NewsController::class, 'addnews'])->name('addnews')->middleware('auth');
Route::post('admin/news/save', [NewsController::class, 'savenews'])->name('savenews')->middleware('auth');
Route::get('admin/news/change/{id}', [NewsController::class, 'changenews'])->name('changenews')->middleware('auth');
Route::post('admin/news/update', [NewsController::class, 'updatenews'])->name('updatenews')->middleware('auth');
Route::get('admin/news/detail/{id}', [NewsController::class, 'detailnews'])->name('detailnews')->middleware('auth');
Route::get('admin/news/delete/{id}', [NewsController::class, 'deletenews'])->name('deletenews')->middleware('auth');
Route::get('/file/{filename}', [NewsController::class, 'getFile'])->name('getFile')->middleware('auth');
//gambar
Route::get('admin/gambar/view', [GambarController::class, 'viewgambar'])->name('viewgambar')->middleware('auth');
Route::get('admin/gambar/add', [GambarController::class, 'addgambar'])->name('addgambar')->middleware('auth');
Route::post('admin/gambar/save', [GambarController::class, 'savegambar'])->name('savegambar')->middleware('auth');
Route::get('admin/gambar/change/{id}', [GambarController::class, 'changegambar'])->name('changegambar')->middleware('auth');
Route::post('admin/gambar/update', [GambarController::class, 'updategambar'])->name('updategambar')->middleware('auth');
Route::get('admin/gambar/detail/{id}', [GambarController::class, 'detailgambar'])->name('detailgambar')->middleware('auth');
Route::get('admin/gambar/delete/{id}', [GambarController::class, 'deletegambar'])->name('deletegambar')->middleware('auth');
//contact
Route::get('admin/contact/view', [ContactController::class, 'viewcontact'])->name('viewcontact')->middleware('auth');
Route::get('admin/contact/detail/{id}', [ContactController::class, 'detailcontact'])->name('detailcontact')->middleware('auth');
Route::get('admin/contact/delete/{id}', [ContactController::class, 'deletecontact'])->name('deletecontact')->middleware('auth');
Route::get('admin/contact/readAll', [ContactController::class, 'readAll'])->name('readAllcontact')->middleware('auth');
//reader
Route::get('readers/detail', [ReaderController::class, 'detailreader'])->name('detailreader');
Route::get('readers/detail/{id}', [ReaderController::class, 'detailreader'])->name('detailreader');
Route::get('readers/category/{kat_berita}', [ReaderController::class, 'category'])->name('category');
Route::get('readers/aboutus', [ReaderController::class, 'aboutus'])->name('aboutus');
Route::get('readers/contactus', [ReaderController::class, 'contactus'])->name('contactus');
Route::post('eaders/contactus/sendmessage', [ReaderController::class, 'sendmessage'])->name('sendmessage');