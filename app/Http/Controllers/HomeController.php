<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LocalMemo;


class HomeController extends Controller
{
    // ホーム画面
    public function showHome()
    {
        return view('Home.home');
    }

    // CHaserOnline画面
    public function showCHaser()
    {
        return view('Home.CHaserOnline.chaser');
    }

    // ローカルメモ画面
    public function showLocalMemo()
    {  
        if(Auth::check() == true)
        {
            $localmemos = LocalMemo::where('user_id', '=', Auth::id())->get();
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

    // ローカルメモ更新処理
    public function updateLocalMemo(Request $request)
    {
        
    }
}
