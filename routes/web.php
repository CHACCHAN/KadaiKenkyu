<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

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

// Auth
// Auth->新規登録
Route::get('/register', [UserController::class, 'showRegister'])->name('Auth.register');
Route::post('/register', [UserController::class, 'register']);
// Auth->アバター登録
Route::middleware('auth')->group(function (){
    Route::get('/register/avatar', [UserController::class, 'showAvatar'])->name('Auth.avatar');
    Route::post('/register/avatar', [UserCOntroller::class, 'avatar']);
});
// Auth->ログイン
Route::get('/login', [UserController::class, 'showLogin'])->name('Auth.login');
Route::post('/login', [UserController::class, 'login']);
// Auth->ログアウト
Route::post('logout', [UserController::class, 'logout'])->name('Auth.logout');

// Profile
Route::middleware('auth')->group(function (){
    // Profile->トップ
    Route::get('/profile/account', [ProfileController::class, 'showAccount'])->name('Profile.account');
    // Profile->セキュリティ
    Route::get('/profile/secure', [ProfileController::class, 'showSecure'])->name('Profile.secure');
});

// Home
// Home->ホーム
Route::get('/', [HomeController::class, 'showHome'])->name('Home.home');

// CHaserOnline
// CHaserOnline->ホーム
