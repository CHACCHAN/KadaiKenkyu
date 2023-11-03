<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 新規登録画面
    public function showRegister()
    {
        return view('Auth.register');
    }

    // 新規登録処理
    public function register(Request $request)
    {
        if(User::where('email', $request->email)->first())
        {
            $message = 'このメールアドレスは既に登録済みです';
            return redirect()->route('Auth.register')->with(compact('message'));
        }
        
        $user = User::query()->create([
            'name'      =>  $request['name'],
            'email'     =>  $request['email'],
            'password'  =>  Hash::make($request['password']),
            'class_id'  =>  $request['class_id'],
            'chaser_id' =>  $request['chaser_id'],
            'chaser_password' => $request['chaser_password'],
        ]);

        Auth::login($user);
 
        return redirect()->route('Auth.avatar')->with([
            'user_name' => User::find(Auth::id())->name,
        ]);
    }

    // アバター登録画面
    public function showAvatar()
    {
        return view('Auth.avatar');
    }

    // アバター登録処理
    public function avatar(Request $request)
    {
        $user = User::find(Auth::id());
        $image_path = $request->file('image')->store('public/avatar/');
        $user->image = basename($image_path);
        $user->update();

        return redirect()->route('Profile.account');
    }

    // ログイン画面
    public function showLogin()
    {
        if(Auth::check() == true)
        {
            return redirect('/');
        }
        return view('Auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->route('Home.home');
        }

        $message = '存在しないメールアドレス、またはパスワードが不明です';
        return back()->with(compact('message'));
    }

    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        
        return back();
    }

    // メールアドレス変更画面
    public function showEmail()
    {
        return view('Auth.email');
    }

    // メールアドレス変更処理
    public function email(Request $request)
    {
        $user = User::find(Auth::id());
        $user->update([
            'email' => $request['email'],
        ]);

        return redirect()->route('Profile.account')->with('message', 'メールアドレスを更新しました');;
    }

    // CHaserOnline変更画面
    public function showChaser()
    {
        return view('Auth.chaser');
    }

    // CHaserOnline変更処理
    public function chaser(Request $request)
    {
        $user = User::find(Auth::id());
        $user->update([
            'chaser_id' => $request['chaser_id'],
            'chaser_password' => $request['chaser_password'],
        ]);

        return redirect()->route('Profile.account')->with('message', 'CHaserOnlineを更新しました');;
    }

    // 学科番号変更画面
    public function showClass()
    {
        return view('Auth.class');
    }

    // 学科番号変更処理
    public function class(Request $request)
    {
        $user = User::find(Auth::id());
        $user->update([
            'class_id' => $request['class_id'],
        ]);

        return redirect()->route('Profile.account')->with('message', '学科番号を更新しました');
    }
}