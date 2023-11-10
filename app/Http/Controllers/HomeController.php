<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Date;
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
        return view('Home.SankougiChat.sankougichat', [
            'sankougi_chats'     =>  SankougiChat::all(),
            'sankougi_chat_user' =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
        ]);
    }

    // 投稿処理
    public function sankougichat(Request $request)
    {
        $sankougi_chat = new SankougiChat;
        $sankougi_chat->chat_user_id = Auth::id();
        $sankougi_chat->title = $request->title;
        $sankougi_chat->content = $request->content;
        // 画像の保存
        for($i = 0; $i < 5; $i++)
        {
            $data = array(
                1 => $request->image,
                2 => $request->image_two,
                3 => $request->image_three,
                4 => $request->image_four,
                5 => $request->image_five,
            );
            
            if($data[$i])
            {
                $image_path = 'PostImage-'. Date::now()->format('Y-m-d-H-i-s-'). $i .'.png';
                Storage::put('public/sankougichat_user/post/' . $image_path, $data[$i]);
                $sankougi_chat->image = $image_path;
            }
        }
        $sankougi_chat->save();
        
        return redirect()->route('Home.sankougichat');
    }

    // プロフィール画面
    public function showSankougiChatProfile($id)
    {
        return view('Home.SankougiChat.sankougichat_profile', [
            'sankougi_chats'     =>  SankougiChat::all(),
            'sankougi_chat_user' =>  SankougiChatUser::where('user_id', '=', $id)->first(),
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
