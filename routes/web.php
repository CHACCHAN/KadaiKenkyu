<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Events\MessageReceivedEvent;

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
Route::post('/sankougichat', [HomeController::class, 'sankougichat']);
// Home->三工技チャット->投稿ピックアップ
Route::get('/sankougichat/pickup/id={name_id}/post={chat_id}', [HomeCOntroller::class, 'showSankougiChatPickup'])->name('Home.sankougi.pickup');
// Home->三工技チャット->いいねわるい
Route::post('/sankougichat/evaluation', [HomeController::class, 'evaluationSankougiChat'])->name('Home.sankougichat.evaluation');

// Home->三工技チャット->コメント
Route::post('/sankougichat/comment/id={name_id}/post={chat_id}', [HomeController::class, 'storeSankougiChatComment'])->name('Home.sankougichat.comment');
// Home->三工技チャット->スレッド
Route::get('/sankougichat/thread', [HomeController::class, 'showSankougiChatThread'])->name('Home.sankougichat.thread');
Route::post('/sankougichat/thread', [HomeController::class, 'sankougichatthread']);

// Home->三工技チャット->スレッド->カテゴリ
Route::get('/sankougichat/thread/category/id={name_id}/thread={sankougi_chat_thread_id}', [HomeController::class, 'showSankougiChatThreadCategory'])->name('Home.sankougichat.thread.category');
// Home->三工技チャット->スレッド->カテゴリ->作成
Route::post('/sankougichat/thread/category/make', [HomeController::class, 'makeSankougiChatThreadCategory'])->name('Home.sankougichat.thread.category.make');
// Home->三工技チャット->スレッド->カテゴリ->更新
Route::post('/sankougichat/thread/category/update', [HomeController::class, 'updateSankougiChatThreadCategory'])->name('Home.sankougichat.thread.category.update');
// Home->三工技チャット->スレッド->カテゴリ->削除
Route::post('/sankougichat/thread/category/delete', [HomeController::class, 'deleteSankougiChatThreadCategory'])->name('Home.sankougichat.thread.category.delete');

// Home->三工技チャット->スレッド->チャンネル
Route::get('/sankougichat/thread/category/channel/id={name_id}/thread={sankougi_chat_thread_id}/category={sankougi_chat_thread_category_id}/channel={sankougi_chat_thread_channel_id}', [HomeController::class, 'showSankougiChatThreadChannel'])->name('Home.sankougichat.thread.channel');
// Home->三工技チャット->スレッド->チャンネル->作成
Route::post('/sankougichat/thread/channel/make', [HomeController::class, 'makeSankougiChatThreadChannel'])->name('Home.sankougichat.thread.channel.make');
// Home->三工技チャット->スレッド->チャンネル->更新
Route::post('/sankougichat/thread/channel/update', [HomeController::class, 'updateSankougiChatThreadChannel'])->name('Home.sankougichat.thread.channel.update');
// Home->三工技チャット->スレッド->チャンネル->削除
Route::post('/sankougichat/thread/channel/delete', [HomeController::class, 'deleteSankougiChatThreadChannel'])->name('Home.sankougichat.thread.channel.delete');

// Home->三工技チャット->スレッド->チャンネル->チャット受信 API
Route::post('/sankougichat/thread/category/channel/chat/get', [HomeController::class, 'getSankougiChatThreadChannelChat'])->name('Home.sankougichat.thread.channel.getchat');
// Home->三工技チャット->スレッド->チャンネル->チャット送信 API
Route::post('/sankougichat/thread/category/channel/chat/post', [HomeController::class, 'postSankougiChatThreadChannelChat'])->name('Home.sankougichat.thread.channel.postchat');

// Home->三工技チャット->スレッド->権限の編集
Route::get('/sankougichat/thread/changejob', [HomeController::class, 'changeSankougiChatThreadJob'])->name('Home.sankougichat.thread.changejob');
Route::post('/sankougichat/thread/changejob', [HomeController::class, 'changeSankougiChatThreadJob']);

// Home->三工技チャット->スレッド->参加
Route::get('/sankougichat/thread/join/id={name_id}/thread={sankougi_chat_thread_id}', [HomeController::class, 'storeSankougiChatThread'])->name('Home.sankougichat.thread.join');
// Home->三工技チャット->スレッド->退出
Route::get('/sankougichat/thread/delete/id={name_id}/thread={sankougi_chat_thread_id}', [HomeController::class, 'deleteSankougiChatThread'])->name('Home.sankougichat.thread.delete');

// Home->三工技チャット->検索
Route::get('/sankougichat/search', [HomeController::class, 'showSankougiChatSearch'])->name('Home.sankougichat.search');
Route::post('/sankougichat/search', [HomeController::class, 'sankougichatsearch']);

// Home->三工技チャット->友達リスト
Route::get('/sankougichat/friend', [HomeController::class, 'showSankougiChatFriend'])->name('Home.sankougichat.friend');

// Home->三工技チャット->プロフィール
Route::get('/sankougichat/profile/id={name_id}', [HomeController::class, 'showSankougiChatProfile'])->name('Home.sankougichat.profile');
// Home->三工技チャット->プロフィール更新
Route::post('/sankougichat/profile/update', [HomeController::class, 'updateSankougiChatProfile'])->name('Home.sankougichat.profile.update');
// Home->三工技チャット->プロフィール登録
Route::get('/sankougichat/adduser', [HomeController::class, 'showSankougiChatProfileCreate'])->name('Home.sankougichat.profile.adduser');
Route::post('/sankougichat/adduser', [HomeController::class, 'sankougichatprofilecreate']);
// Home->三工技チャット->プロフィール登録->検索IDの生成
Route::get('/sankougichat/userid', [HomeController::class, 'createSankougiChatProfileID'])->name('Home.sankougichat.profile.userid');

// Home->三工技チャット->フォロー$フォロワー一覧画面
Route::get('/sankougichat/follow/id={name_id}/{type}', [HomeController::class, 'showSankougiChatFollow'])->name('Home.sankougichat.follow');
// Home->三工技チャット->フォロー登録
Route::post('/sankougichat/follow/store', [HomeController::class, 'storeSankougiChatFollow'])->name('Home.sankougichat.follow.store');
// Home->三工技チャット->フォロー解除
Route::post('/sankougichat/follow/delete', [HomeController::class, 'deleteSankougiChatFollow'])->name('Home.sankougichat.follow.delete');


/************************************************/
/*                                              */
/*              ホーム/カレンダー/*              */
/*                                              */
/************************************************/
// Home->カレンダー
Route::get('/calendar', [HomeController::class, 'showCalendar'])->name('Home.calendar');
// Home->カレンダー->登録情報
Route::post('/calendar/get', [HomeController::class, 'getCalendar'])->name('Home.calendar.get');
Route::post('/calendar/post', [HomeController::class, 'postCalendar'])->name('Home.calendar.post');

/************************************************/
/*                                              */
/*               入退室フォーム/*                */
/*                                              */
/************************************************/
Route::get('/joinout', [HomeController::class, 'showJoinOutForm'])->name('Home.joinout');
Route::post('/joinout', [HomeController::class, 'joinoutform']);
Route::get('/joinout/exit', [HomeController::class, 'deleteJoinOutForm'])->name('Home.joinout.exit');

/************************************************/
/*                                              */
/*                   ゲーム/*                   */
/*                                              */
/************************************************/
// ナンプレ
Route::get('/game/releases/numberplate', [GameController::class, 'showNumberPlate'])->name('Game.numberplate');