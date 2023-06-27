<?php

use App\Http\Controllers\ContactController;
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
Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard')->middleware('auth');
//login
Route::get('login', function () {
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
Route::get('admin/file/{filename}', [NewsController::class, 'getFile'])->name('getFile')->middleware('auth');
Route::get('admin/list-files', [NewsController::class, 'getListFiles'])->name('getListFiles')->middleware('auth');
//contact
Route::get('admin/contact/view', [ContactController::class, 'viewcontact'])->name('viewcontact')->middleware('auth');
Route::get('admin/contact/detail/{id}', [ContactController::class, 'detailcontact'])->name('detailcontact')->middleware('auth');
Route::get('admin/contact/delete/{id}', [ContactController::class, 'deletecontact'])->name('deletecontact')->middleware('auth');
Route::get('admin/contact/readAll', [ContactController::class, 'readAll'])->name('readAllcontact')->middleware('auth');
//reader
Route::get('readers/detail', [ReaderController::class, 'detailreader'])->name('detailreader');
// Route::get('reader/detail/{id}', [ReaderController::class, 'detailreader'])->name('detailreader');
Route::get('readers/aboutus', [ReaderController::class, 'aboutus'])->name('aboutus');
Route::get('reader/contactus', [ReaderController::class, 'contactus'])->name('contactus');