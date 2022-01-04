<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();
// SORTED BY CONTROLLER
// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'getLatestVideos'])->name('home');
Route::get('/home/{category_name}', [App\Http\Controllers\HomeController::class, 'getLatestVideosByCategory'])->name('homeCategorie');
Route::get('/user/{name}', [App\Http\Controllers\HomeController::class, 'getUserVideos']);

// User Route
Route::get('/profile', [App\Http\Controllers\UserController::class, 'home']);
Route::post('/profile_picture', [App\Http\Controllers\UserController::class, 'uploadProfilePicture']);

Route::get('/video/{uuid}', [App\Http\Controllers\VideoController::class, 'getVideoByUuid']);
Route::post('/uploadVideo', [App\Http\Controllers\VideoController::class, 'uploadVideo']);

Route::get('/search', [App\Http\Controllers\VideoController::class, 'getSearchResults']);

