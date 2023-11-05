<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\LocalMemo;
use App\Models\SankougiChat;
use App\Models\SankougiChatUser;
use App\Models\SankougiChatComment;
use App\Models\SankougiChatFollow;


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
        $sankougi_chats = SankougiChat::all();
        $sankougi_chat_user = SankougiChatUser::where('user_id', '=', Auth::id())->first();

        return view('Home.SankougiChat.sankougichat', [
            'sankougi_chats'     =>  $sankougi_chats,
            'sankougi_chat_user' =>  $sankougi_chat_user,
        ]);
    }

    // 投稿処理
    public function sankougichat(Request $request)
    {
        
    }

    // プロフィール登録画面
    public function showSankougiChatProfile()
    {
        return view('Home.SankougiChat.sankougichat_user');
    }

    // プロフィール登録処理
    public function sankougichatprofile(Request $request)
    {

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
