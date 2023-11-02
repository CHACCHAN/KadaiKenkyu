<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // トップ画面
    public function showAccount()
    {
        return view('Profile.account');
    }

    // セキュリティ画面
    public function showSecure()
    {
        return view('Profile.secure');
    }
}
