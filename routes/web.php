<?php

use App\Http\Controllers\RouterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::any('/', function () {
    return view('auth/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Untuk Route Utama
Auth::routes();
Route::any('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/home', [App\Http\Controllers\HomeController::class, ''])->name('home');
Route::get('display-user', [App\Http\Controllers\HomeController::class, 'getIpAddress']);

// untuk  Route Login Register Route
Route::post('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'userRegister'])->name('user.register');
Route::get('/hotspot/users',[RouterController::class, 'hotspotUsers']);



// Untuk Route Koneksi Wifi 
Route::get('/subscription', [RouterController::class, 'subscription'])->name('user.subscribe')->middleware('auth');
Route::get('/connecttoWifi', [RouterController::class, 'connecttoWifi']);



//Google Login 
Route::prefix('google')->name('google.')->group( function(){
    Route::get('auth', [App\Http\Controllers\Auth\SocialiteController::class, 'loginwithgoogle'])->name('login');
    Route::get('callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callbackwithgoogle'])->name('callback');
});

//Facebook Login 
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [App\Http\Controllers\Auth\SocialiteController::class, 'loginwithfacebook'])->name('login');
    Route::get('callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callbackwithfacebook'])->name('callback');
});

//Github Login 
Route::prefix('github')->name('github.')->group( function(){
    Route::get('auth', [App\Http\Controllers\Auth\SocialiteController::class, 'loginwithGithub'])->name('login');
    Route::get('callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callbackwithgithub'])->name('callback');
});
