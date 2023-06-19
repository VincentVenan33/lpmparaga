<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('news',[PostController::class,'getNews']);
Route::get('news/{id}', [PostController::class, 'getNewsDetail']);
Route::get('/image/{filename}',[PostController::class,'getImage']);
Route::get('/list-file',[PostController::class,'getImageList']);
Route::get('contact',[PostController::class,'getContact']);
Route::post('contact',[PostController::class,'postContact']);
Route::get('pengunjung', [PostController::class, 'getpengunjung']);
Route::post('pengunjung', [PostController::class, 'getpengunjung']);
?>