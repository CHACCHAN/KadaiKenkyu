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

Route::get('/laravel', function () {
    return view('welcome');
});


/************************************************/
/*                                              */
/*                 ログイン機能/*                */
/*                                              */
/************************************************/
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


/************************************************/
/*                                              */
/*                プロフィール/*                 */
/*                                              */
/************************************************/
Route::middleware('auth')->group(function (){
    // Profile->トップ
    Route::get('/profile/account', [ProfileController::class, 'showAccount'])->name('Profile.account');
    // Profile->セキュリティ
    Route::get('/profile/secure', [ProfileController::class, 'showSecure'])->name('Profile.secure');
});


/************************************************/
/*                                              */
/*                  ホーム/*                     */
/*                                              */
/************************************************/
// Home->ホーム
Route::get('/', [HomeController::class, 'showHome'])->name('Home.home');


/************************************************/
/*                                              */
/*             ホーム/CHaserOnline/*             */
/*                                              */
/************************************************/
// Home->CHaserOnline
Route::get('/chaseronline', [HomeController::class, 'showCHaser'])->name('Home.chaser');


/************************************************/
/*                                              */
/*              ホーム/ローカルメモ/*             */
/*                                              */
/************************************************/
// Home->ローカルメモ
Route::get('/localmemo', [HomeController::class, 'showLocalMemo'])->name('Home.localmemo');
Route::post('/localmemo', [HomeController::class, 'localmemo']);
// Home->ローカルメモ->更新
Route::post('/localmemo/update', [HomeController::class, 'updateLocalMemo'])->name('Home.localmemo.update');
// Home->ローカルメモ->削除
Route::get('/localmemo/delete/id={delete_id}', [HomeController::class, 'deleteLocalMemo'])->name('Home.localmemo.delete');
// Home->ローカルメモ->削除->画像のみ
Route::get('/localmemo/only_image_delete/id={delete_id}', [HomeController::class, 'deleteLocalMemoImage'])->name('Home.localmemo.delete.image');


/************************************************/
/*                                              */
/*            ホーム/三工技チャット/*             */
/*                                              */
/************************************************/
// Home->三工技チャット
Route::get('/sankougichat', [HomeController::class, 'showSankougiChat'])->name('Home.sankougichat');