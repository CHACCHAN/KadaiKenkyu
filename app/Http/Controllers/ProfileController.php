<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Date;
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
use App\Models\JoinOutLog;
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
            'users'                      => User::orderBy('id', 'ASC')->take($ViewCount)->get(),
            'count'                      => User::count() - $ViewCount,
            'viewcount'                  => $ViewCount,
            'localmemos'                 => LocalMemo::latest()->get(),
            'sankougi_chat_user'         => SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chats'             => SankougiChat::get(),
            'sankougi_chat_follows'      => SankougiChatFollow::get(),
            'sankougi_chat_threads'      => SankougiChatThread::get(),
            'sankougi_chat_thread_joins' => SankougiChatThreadJoin::get(),
            'joinouts'                    => JoinOut::get(),
            'joinout_rooms'              => JoinOutRoom::get(),
            'joinout_logs'               => JoinOutLog::get(),
        ]);
    }

    // アカウント管理者昇格
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

    // ピックアップ投稿API
    public function uploadPickUp(Request $request)
    {
        // 10件を超えたら削除
        if(PickUp::count() == 10)
        {
            $pickup_old = PickUp::oldest('created_at')->first();

            if($pickup_old->image)
            {
                Storage::disk('public')->delete('pickup/' . $pickup_old->image);
            }
            if(PickUpRead::where('pickup_id', '=', $pickup_old->id)->exists())
            {
                PickUpRead::where('pickup_id', '=', $pickup_old->id)->delete();
            }
            
            PickUp::where('id', '=', $pickup_old->id)->delete();
        }

        $pickup = new PickUp();
        $pickup->title = $request->title;
        $pickup->content = $request->content;
        $pickup->type = $request->type;
        // 画像の保存
        if($request->image) {
            $image = base64_decode(preg_replace('/^data:image.*base64,/', '', str_replace(' ', '+', $request->image)));
            $image_path = 'PickUpImage-' . Date::now()->format('Y-m-d-H-i-s') . '.png';
            Storage::put('public/pickup/' . $image_path, $image);
            $pickup->image = $image_path;
        }

        $pickup->save();

        return response()->json([], 200);
    }

    // ピックアップ取得API
    public function getPickUp()
    {
        return response()->json([
            'pickups' => PickUp::latest()->get(),
            'count'   => PickUp::count(),
        ], 200);
    }

    // ピックアップ削除API
    public function deletePickUp(Request $request)
    {
        $pickup = PickUp::where('id', '=', $request->id)->first();
        
        if($pickup->image)
        {
            Storage::disk('public')->delete('pickup/' . $pickup->image);
        }
        if(PickUpRead::where('pickup_id', '=', $pickup->id)->exists())
        {
            PickUpRead::where('pickup_id', '=', $pickup->id)->delete();
        }

        PickUp::where('id', '=', $pickup->id)->delete();

        return response()->json([], 200);
    }
}
