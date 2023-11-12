<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use App\Models\LocalMemo;
use App\Models\SankougiChat;
use App\Models\SankougiChatComment;
use App\Models\SankougiChatEvaluation;
use App\Models\SankougiChatFollow;
use App\Models\SankougiChatUser;


class HomeController extends Controller
{
    /************************************************/
    /*                                              */
    /*                  ホーム                      */
    /*                                              */
    /************************************************/
    // ホーム画面
    public function showHome()
    {
        return view('Home.home');
    }

    /************************************************/
    /*                                              */
    /*               CHaserOnline                   */
    /*                                              */
    /************************************************/
    // CHaserOnline画面
    public function showCHaser()
    {
        return view('Home.CHaserOnline.chaser');
    }

    /************************************************/
    /*                                              */
    /*                ローカルメモ                   */
    /*                                              */
    /************************************************/
    // ローカルメモ画面
    public function showLocalMemo()
    {  
        if(Auth::check() == true)
        {
            $localmemos = LocalMemo::where('user_id', '=', Auth::id())->latest()->get();
            return view('Home.LocalMemo.localmemo',[
                'localmemos' => $localmemos,
            ]);
        }
        else
        {
            return redirect()->route('Auth.login');
        }
    }

    // ローカルメモ作成処理
    public function localmemo(Request $request)
    {
        if(!$request->title && !$request->content)
        {
            return redirect()->route('Home.localmemo');
        }

        $localmemo = new LocalMemo;
        $localmemo->user_id = Auth::id();
        $localmemo->title = $request->title;
        $localmemo->content = $request->content;
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/localmemo/');
            $localmemo->image = basename($image_path);
        }
        $localmemo->save();

        return redirect()->route('Home.localmemo');
    }

    // ローカルメモ更新処理 : Ajax
    public function updateLocalMemo(Request $request)
    {
        $localmemo = LocalMemo::find($request->id);
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/localmemo/');
            if($localmemo->image)
            {
                Storage::disk('public')->delete('localmemo/'. $localmemo->image);
            }
            $localmemo->image = basename($image_path);
            $localmemo->update();

            return redirect()->route('Home.localmemo');
        }

        $localmemo->update([
            'title'   =>  $request->title,
            'content' =>  $request->content,
        ]);

        return response()->json([
            'title'      =>  $localmemo->title,
            'content'    =>  $localmemo->content,
            'updated_at' =>  $localmemo->updated_at->format('Y-m-d H:i:s'),
        ]);
    }

    // ローカルメモ削除処理
    public function deleteLocalMemo($delete_id)
    {
        $localmemo = LocalMemo::find($delete_id);
        Storage::disk('public')->delete('localmemo/'. $localmemo->image);
        $localmemo->delete();

        return redirect()->route('Home.localmemo');
    }

    // ローカルメモ画像のみ削除処理
    public function deleteLocalMemoImage($delete_id)
    {
        $localmemo = LocalMemo::find($delete_id);
        Storage::disk('public')->delete('localmemo/'. $localmemo->image);
        $localmemo->update([
            'image' => null,
        ]);

        return redirect()->route('Home.localmemo');
    }

    /************************************************/
    /*                                              */
    /*                三工技チャット                 */
    /*                                              */
    /************************************************/
    // 投稿ホーム画面
    public function showSankougiChat()
    {
        return view('Home.SankougiChat.sankougichat', [
            'sankougi_chats'            =>  SankougiChat::latest()->get(),
            'sankougi_chat_users'       =>  SankougiChatUser::get(),
            'sankougi_chat_none_user'   =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_evaluations' =>  SankougiChatEvaluation::where('user_id', '=', Auth::id())->get(),
            'sankougi_chat_comments'    =>  SankougiChatComment::get(),
        ]);
    }

    // 投稿処理
    public function sankougichat(Request $request)
    {
        // 投稿データをDBに保存
        $sankougi_chat = new SankougiChat;
        $sankougi_chat->chat_user_id = Auth::id();
        $sankougi_chat->content = $request->content;
        // 画像の保存
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/sankougichat/post/');
            $sankougi_chat->image = basename($image_path);
        }
        $sankougi_chat->save();
        
        return redirect()->route('Home.sankougichat');
    }

    // 投稿ピックアップ画面
    public function showSankougiChatPickup($name_id, $chat_id)
    {
        return view('Home.SankougiChat.sankougichat_pickup', [
            'sankougi_chat'             =>  SankougiChat::where('chat_id', '=', $chat_id)->first(),
            'sankougi_chat_users'       =>  SankougiChatUser::get(),
            'sankougi_chat_none_user'   =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_user'        =>  SankougiChatUser::where('name_id', '=', $name_id)->first(),
            'sankougi_chat_evaluations' =>  SankougiChatEvaluation::where('user_id', '=', Auth::id())->get(),
            'sankougi_chat_comments'    =>  SankougiChatComment::latest()->get(),
        ]);
    }

    // いいねわるい処理 : Fetch
    public function evaluationSankougiChat(Request $request)
    {
        // 登録処理
        if(SankougiChatEvaluation::where([
            ['user_id', '=', $request->user_id],
            ['chat_id', '=', $request->chat_id],
        ])->exists() == false)
        {
            // いいねだったら
            if($request->good_count)
            {
                // いいね数の更新
                SankougiChat::where('chat_id', '=', $request->chat_id)->update([
                    'good_count' => $request->good_count - 1,
                ]);
                // ユーザの入力済みDBを作成
                $sankougi_chat_evaluation = new SankougiChatEvaluation;
                $sankougi_chat_evaluation->user_id   = $request->user_id;
                $sankougi_chat_evaluation->chat_id   = $request->chat_id;
                $sankougi_chat_evaluation->good_flag = 1;
                $sankougi_chat_evaluation->save();
            }
            // わるいだったら
            else if($request->bad_count)
            {
                // わるい数の更新
                SankougiChat::where('chat_id', '=', $request->chat_id)->update([
                    'bad_count' => $request->bad_count - 1,
                ]);
                // ユーザの入力済みDBを作成
                $sankougi_chat_evaluation = new SankougiChatEvaluation;
                $sankougi_chat_evaluation->user_id   = $request->user_id;
                $sankougi_chat_evaluation->chat_id   = $request->chat_id;
                $sankougi_chat_evaluation->bad_flag = 1;
                $sankougi_chat_evaluation->save();
            }
        }
        // 取り消し処理
        else if(SankougiChatEvaluation::where([
            ['user_id', '=', $request->user_id],
            ['chat_id', '=', $request->chat_id],
        ])->exists() == true)
        {
            // いいねだったら
            if($request->good_count)
            {
                // いいね数の更新
                SankougiChat::where('chat_id', '=', $request->chat_id)->update([
                    'good_count' => $request->good_count - 1,
                ]);
                // ユーザの入力済みDBを削除
                SankougiChatEvaluation::where([
                    ['user_id', '=', $request->user_id],
                    ['chat_id', '=', $request->chat_id],
                ])->delete();
            }
            // わるいだったら
            else if($request->bad_count)
            {
                // いいね数の更新
                SankougiChat::where('chat_id', '=', $request->chat_id)->update([
                    'bad_count' => $request->bad_count - 1,
                ]);
                // ユーザの入力済みDBを削除
                SankougiChatEvaluation::where([
                    ['user_id', '=', $request->user_id],
                    ['chat_id', '=', $request->chat_id],
                ])->delete();
            }
        }
    }

    // コメント処理
    public function storeSankougiChatComment(Request $request, $name_id, $chat_id)
    {
        $sankougi_chat_user = SankougiChatUser::where('name_id', '=', $name_id)->first();
        $sankougi_chat_comment = new SankougiChatComment;
        $sankougi_chat_comment->chat_user_id = $sankougi_chat_user->chat_user_id;
        $sankougi_chat_comment->chat_id = $chat_id;
        $sankougi_chat_comment->content = $request->content;
        // 画像の保存
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/sankougichat_comment/post/');
            $sankougi_chat_comment->image = basename($image_path);
        }
        $sankougi_chat_comment->save();

        return back();
    }

    // プロフィール画面
    public function showSankougiChatProfile($name_id)
    {
        return view('Home.SankougiChat.sankougichat_profile', [
            'sankougi_chats'     =>  SankougiChat::all(),
            'sankougi_chat_none_user'   =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_user' =>  SankougiChatUser::where('name_id', '=', $name_id)->first(),
        ]);
    }

    // プロフィール更新処理 : Fetch
    public function updateSankougiChatProfile(Request $request)
    {
        $sankougi_chat_user = SankougiChatUser::where('user_id', '=', Auth::id());

        // ヘッダー画像を保存
        if($request->image_header)
        {
            // Data-URLの削除とデコード
            $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image_header)));
            $image_path = 'HeaderImage-'. Date::now()->format('Y-m-d-H-i-s'). '.png';

            // 画像の保存処理
            Storage::disk('public/sankougichat_user/header')->delete($sankougi_chat_user->image_header);
            Storage::put('public/sankougichat_user/header/' . $image_path, $image);
            $sankougi_chat_user->update([
                'image_header' => $image_path,
            ]);
        }

        // アバター画像を保存
        if($request->image_avatar)
        {
            // Data-URLの削除とデコード
            $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image_avatar)));
            $image_path = 'AvatarImage-'. Date::now()->format('Y-m-d-H-i-s'). '.png';

            // 画像の保存処理
            Storage::disk('public/sankougichat_user/avatar')->delete($sankougi_chat_user->image_avatar);
            Storage::put('public/sankougichat_user/avatar/' . $image_path, $image);
            $sankougi_chat_user->update([
                'image_avatar' => $image_path,
            ]);
        }

        if($request->name && $request->content)
        {
            $sankougi_chat_user->update([
                'name'         =>  $request->name,
                'content'      =>  $request->content,
            ]);
        }
    }

    // プロフィール登録画面
    public function showSankougiChatProfileCreate()
    {
        // キャンセル処理
        if(SankougiChatUser::where('user_id', '=', Auth::id())->exists() == true)
        {
            return redirect()->route('Home.sankougichat');
        }

        return view('Home.SankougiChat.sankougichat_user');
    }

    // プロフィール登録処理 : Fetch
    public function sankougichatprofilecreate(Request $request)
    {
        $sankougi_chat_user = new SankougiChatUser;
        $sankougi_chat_user->user_id = Auth::id();
        $sankougi_chat_user->name = $request->name;
        $sankougi_chat_user->name_id = $request->name_id;
        $sankougi_chat_user->content = $request->content;

        // ヘッダー画像を保存
        if($request->image_header)
        {
            // Data-URLの削除とデコード
            $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image_header)));
            $image_path = 'HeaderImage-'.Date::now()->format('Y-m-d-H-i-s').'.png';

            // 画像の保存処理
            Storage::put('public/sankougichat_user/header/' . $image_path, $image);
            $sankougi_chat_user->image_header = $image_path;
        }

        // アバター画像を保存
        if($request->image_avatar)
        {
            // Data-URLの削除とデコード
            $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image_avatar)));
            $image_path = 'AvatarImage-'.Date::now()->format('Y-m-d-H-i-s').'.png';

            // 画像の保存処理
            Storage::put('public/sankougichat_user/avatar/' . $image_path, $image);
            $sankougi_chat_user->image_avatar = $image_path;
        }
        $sankougi_chat_user->save();
    }

    // 検索IDの生成処理
    public function createSankougiChatProfileID()
    {
        do {
            $name_id = Str::random(16); // 16文字のランダムな16進数のIDを生成
        } while (SankougiChatUser::where('name_id', '=', $name_id)->exists());

        return response()->json(['name_id' => $name_id]);
    }
}
