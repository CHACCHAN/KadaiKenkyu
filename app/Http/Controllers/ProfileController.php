<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocalMemo;
use App\Models\SankougiChat;
use App\Models\SankougiChatComment;
use App\Models\SankougiChatEvaluation;
use App\Models\SankougiChatFollow;
use App\Models\SankougiChatFollower;
use App\Models\SankougiChatStamp;
use App\Models\SankougiChatStampGroup;
use App\Models\SankougiChatThread;
use App\Models\SankougiChatThreadCategory;
use App\Models\SankougiChatThreadChannel;
use App\Models\SankougiChatThreadChannelChat;
use App\Models\SankougiChatThreadJob;
use App\Models\SankougiChatThreadJoin;
use App\Models\SankougiChatUser;
use App\Models\Calendar;
use App\Models\JoinOut;
use App\Models\JoinOutRoom;
use App\Models\PickUp;
use App\Models\PickUpRead;

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

    // ダッシュボード画面
    public function showDashBoard()
    {
        $ViewCount = 3;

        return view('Profile.dashboard', [
            'users' => User::orderBy('id', 'ASC')->take($ViewCount)->get(),
            'count' => User::count() - $ViewCount,
            'viewcount' => $ViewCount,
        ]);
    }

    // アカウント管理者昇格API
    public function upgradeAccount($id)
    {
        User::where('id', '=', $id)->update([
            'admin_flag' => true,
        ]);

        return back();
    }

    // アカウント生徒降格
    public function downgradeAccount($id)
    {
        User::where('id', '=', $id)->update([
            'admin_flag' => false,
        ]);

        return back();
    }

    // アカウント検索API
    public function searchAccount(Request $request)
    {
        return response()->json([
            'users' => User::where('name', 'LIKE', '%' . $request->name . '%')->orderBy('id', 'ASC')->take($request->viewcount)->get(),
        ], 200);
    }

    // アカウント取得API
    public function getAccount(Request $request)
    {
        if(User::count() - $request->max < 0)
        {
            $count = 0;
        }
        else
        {
            $count = User::count() - $request->max;
        }

        return response()->json([
            'users' => User::orderBy('id', 'ASC')->take($request->max)->get(),
            'count' => $count,
        ], 200);
    }
}
