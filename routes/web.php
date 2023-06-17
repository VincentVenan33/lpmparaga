<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfilController;
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
Route::get('/', [HomeController::class, 'home'])->name('index')->middleware('auth');
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
Route::get('users/view', [UsersController::class, 'viewusers'])->name('viewusers')->middleware('auth');
Route::get('users/add', [UsersController::class, 'addusers'])->name('addusers')->middleware('auth');
Route::post('users/save', [UsersController::class, 'saveusers'])->name('saveusers')->middleware('auth');
Route::get('users/change/{id}', [UsersController::class, 'changeusers'])->name('changeusers')->middleware('auth');
Route::post('users/update', [UsersController::class, 'updateusers'])->name('updateusers')->middleware('auth');
Route::get('users/delete/{id}', [UsersController::class, 'deleteusers'])->name('deleteusers')->middleware('auth');
//profile
Route::get('profile/change', [ProfilController::class, 'changeprofil'])->name('changeprofil')->middleware('auth');
Route::post('profile/update', [ProfilController::class, 'updateprofile'])->name('updateprofile')->middleware('auth');
Route::get('profile/delete', [ProfilController::class, 'deleteprofil'])->name('deleteprofil')->middleware('auth');
//news
Route::get('news/view', [NewsController::class, 'viewnews'])->name('viewnews')->middleware('auth');
Route::get('news/add', [NewsController::class, 'addnews'])->name('addnews')->middleware('auth');
Route::post('news/save', [NewsController::class, 'savenews'])->name('savenews')->middleware('auth');
Route::get('news/change/{id}', [NewsController::class, 'changenews'])->name('changenews')->middleware('auth');
Route::post('news/update', [NewsController::class, 'updatenews'])->name('updatenews')->middleware('auth');
Route::get('news/detail/{id}', [NewsController::class, 'detailnews'])->name('detailnews')->middleware('auth');
Route::get('news/delete/{id}', [NewsController::class, 'deletenews'])->name('deletenews')->middleware('auth');
Route::get('/file/{filename}', [NewsController::class, 'getFile'])->name('getFile');
Route::get('/list-files', [NewsController::class, 'getListFiles'])->name('getListFiles');
//contact
Route::get('contact/view', [ContactController::class, 'viewcontact'])->name('viewcontact')->middleware('auth');
Route::get('contact/detail/{id}', [ContactController::class, 'detailcontact'])->name('detailcontact')->middleware('auth');