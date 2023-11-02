<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('Home.LocalMemo.localmemo');
    }
}
