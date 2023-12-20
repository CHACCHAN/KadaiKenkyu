<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'first_name'      =>  $request['first_name'],
            'last_name'       =>  $request['last_name'],
            'name'            =>  $request['name'],
            'email'           =>  $request['email'],
            'password'        =>  Hash::make($request['password']),
            'class_id'        =>  $request['class_id'],
            'chaser_id'       =>  $request['chaser_id'],
            'chaser_password' =>  $request['chaser_password'],
            'admin_flag'      =>  false,
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

    // アバター登録処理 : Fetch
    public function avatar(Request $request)
    {
        // Data-URLの削除とデコード
        $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image)));
        $image_path = 'Avatar-' . Date::now()->format('Y-m-d-H-i-s') . '.png';

        // 更新チェックと画像保存
        $user = User::where('id', '=', Auth::id())->first();

        if($user->image)
        {
            Storage::disk('public')->delete('avatar/' . $user->image);
        }
        Storage::put('public/avatar/' . $image_path, $image);
        $user->update([
            'image' => $image_path,
        ]);

        return response()->json([
            'link' => route('Profile.account'),
        ], 200);
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

    // 名前変更画面
    public function showName()
    {
        return view('Auth.name');
    }

    // 名前変更処理
    public function name(Request $request)
    {
        User::where('id', '=', Auth::id())->update([
            'name'       =>  $request->name,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
        ]);

        $message = '名前情報を更新しました';
        return redirect()->route('Profile.account')->with(compact('message'));
    }

    // メールアドレス変更画面
    public function showEmail()
    {
        return view('Auth.email');
    }

    // メールアドレス変更処理
    public function email(Request $request)
    {
        User::where('id', '=', Auth::id())->update([
            'email' => $request->email,
        ]);

        $message = 'メールアドレスを更新しました';
        return redirect()->route('Profile.account')->with(compact('message'));
    }

    // パスワード変更画面
    public function showPassword($check)
    {
        if(Hash::check($check, Auth::user()->password))
        {
            return view('Auth.password', [
                'password' => $check,
            ]);
        }
        else
        {
            $message = 'パスワードを確認してください';
            return redirect()->route('Profile.account')->with(compact('message'));
        }
    }

    // パスワード変更処理
    public function password(Request $request)
    {
        User::where('id', '=', Auth::id())->update([
            'password' => Hash::make($request->password),
        ]);

        $message = '正常に変更されました';
        return redirect()->route('Profile.account')->with(compact('message'));
    }

    // パスワード変更確認画面
    public function showPasswordCheck()
    {
        return view('Auth.password_check');
    }

    // パスワード変更確認処理
    public function passwordcheck(Request $request)
    {
        if(Hash::check($request->password, Auth::user()->password))
        {
            return redirect()->route('Auth.password', $request->password);
        }
        else
        {
            $message = 'パスワードが一致しません';
            return redirect()->back()->with(compact('message'));
        }
    }

    // CHaserOnline変更画面
    public function showChaser()
    {
        return view('Auth.chaser');
    }

    // CHaserOnline変更処理
    public function chaser(Request $request)
    {
        User::where('id', '=', Auth::id())->update([
            'chaser_id' => $request->chaser_id,
            'chaser_password' => $request->chaser_password,
        ]);

        $message = 'CHaserOnlineを更新しました';
        return redirect()->route('Profile.account')->with(compact('message'));
    }

    // 学科番号変更画面
    public function showClass()
    {
        return view('Auth.class');
    }

    // 学科番号変更処理
    public function class(Request $request)
    {
        User::where('id', '=', Auth::id())->update([
            'class_id' => $request->class_id,
        ]);

        $message = '学科番号を更新しました';
        return redirect()->route('Profile.account')->with(compact('message'));
    }
}