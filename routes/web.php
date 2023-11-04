<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::get('/register', [AuthController::class, 'showRegister'])->name('Auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->group(function (){
    // Auth->アバター登録
    Route::get('/register/avatar', [AuthController::class, 'showAvatar'])->name('Auth.avatar');
    Route::post('/register/avatar', [AuthCOntroller::class, 'avatar']);
    // Auth->メールアドレス変更
    Route::get('/register/email', [AuthController::class, 'showEmail'])->name('Auth.email');
    Route::post('/register/email', [AuthController::class, 'email']);
    // Auth->CHaserOnline変更
    Route::get('/register/chaser', [AuthController::class, 'showChaser'])->name('Auth.chaser');
    Route::post('/register/chaser', [AuthController::class, 'chaser']);
    // Auth->学科番号変更
    Route::get('/register/class', [AuthController::class, 'showClass'])->name('Auth.class');
    Route::post('/register/class', [AuthController::class, 'class']);
});
// Auth->ログイン
Route::get('/login', [AuthController::class, 'showLogin'])->name('Auth.login');
Route::post('/login', [AuthController::class, 'login']);
// Auth->ログアウト
Route::post('logout', [AuthController::class, 'logout'])->name('Auth.logout');

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
// Home->CHaserOnline
Route::get('/chaseronline', [HomeController::class, 'showCHaser'])->name('Home.chaser');
// Home->ローカルメモ
Route::get('/localmemo', [HomeController::class, 'showLocalMemo'])->name('Home.localmemo');
Route::post('/localmemo', [HomeController::class, 'localmemo']);
Route::post('/localmemo/update', [HomeController::class, 'updateLocalMemo'])->name('Home.localmemo.update');