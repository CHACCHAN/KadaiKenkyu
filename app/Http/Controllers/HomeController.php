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
        $sankougi_chat->chat_user_id = SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id;
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

    // スレッド画面
    public function showSankougiChatThread()
    {
        $sankougi_chat_user = SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id;
        
        return view('Home.SankougiChat.sankougichat_thread', [
            'sankougi_chat_users'             =>  SankougiChatUser::get(),
            'sankougi_chat_none_user'         =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_user'              =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_threads'           =>  SankougiChatThread::latest()->get(),
            'sankougi_chat_thread_joins'      =>  SankougiChatThreadJoin::get(),
            'sankougi_chat_thread_join_count' =>  SankougiChatThreadJoin::where('chat_user_id', '=', $sankougi_chat_user)->get()->count(),
        ]);
    }

    // スレッド処理
    public function sankougichatthread(Request $request)
    {
        // スレッド情報を登録
        $sankougi_chat_thread = new SankougiChatThread;
        $sankougi_chat_thread->chat_user_id = SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id;
        $sankougi_chat_thread->title = $request->title;
        $sankougi_chat_thread->content = $request->content;
        $sankougi_chat_thread->join_count = 1;
        // 画像の保存
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/sankougichat_thread/image/');
            $sankougi_chat_thread->image = basename($image_path);
        }
        $sankougi_chat_thread->save();
        // スレッドの最新情報を取得
        $sankougi_chat_thread = SankougiChatThread::where('chat_user_id', '=', SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id)->latest()->first();

        // スレッド参加者を設定
        $sankougi_chat_thread_join = new SankougiChatThreadJoin;
        $sankougi_chat_thread_join->sankougi_chat_thread_id = $sankougi_chat_thread->id;
        $sankougi_chat_thread_join->chat_user_id = Auth::id();
        $sankougi_chat_thread_join->save();

        // スレッドジョブを管理者へ設定
        $sankougi_chat_thread_job = new SankougiChatThreadJob;
        $sankougi_chat_thread_job->sankougi_chat_thread_id = $sankougi_chat_thread->id;
        $sankougi_chat_thread_job->chat_user_id = Auth::id();
        $sankougi_chat_thread_job->admin_flag = true;
        $sankougi_chat_thread_job->save();

        // スレッドカテゴリを作成
        $sankougi_chat_thread_category = new SankougiChatThreadCategory;
        $sankougi_chat_thread_category->sankougi_chat_thread_id = $sankougi_chat_thread->id;
        $sankougi_chat_thread_category->title = '新しいカテゴリ';
        $sankougi_chat_thread_category->save();

        // スレッドチャンネルを作成
        $sankougi_chat_thread_channel = new SankougiChatThreadChannel;
        $sankougi_chat_thread_channel->sankougi_chat_thread_category_id = SankougiChatThreadCategory::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread->id)->first()->id;
        $sankougi_chat_thread_channel->title = '新しいチャンネル';
        $sankougi_chat_thread_channel->save();

        return redirect()->back();
    }

    // スレッドカテゴリ画面
    public function showSankougiChatThreadCategory($name_id, $sankougi_chat_thread_id)
    {
        $sankougi_chat_user = SankougiChatUser::where([
            ['name_id', '=', $name_id],
            ['user_id', '=', Auth::id()],
        ])->first();
        // 参加済みのスレッドかのチェック
        if($sankougi_chat_user)
        {
            return view('Home.SankougiChat.sankougichat_thread_category', [
                'sankougi_chat_none_user'            =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
                'sankougi_chat_user'                 =>  $sankougi_chat_user,
                'sankougi_chat_users'                =>  SankougiChatUser::get(),
                'sankougi_chat_thread'               =>  SankougiChatThread::where('id', '=', $sankougi_chat_thread_id)->first(),
                'sankougi_chat_thread_categorys'     =>  SankougiChatThreadCategory::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
                'sankougi_chat_thread_channels'      =>  SankougiChatThreadChannel::get(),
                'sankougi_chat_thread_job'           =>  SankougiChatThreadJob::where([['sankougi_chat_thread_id', '=', $sankougi_chat_thread_id],['chat_user_id', '=', $sankougi_chat_user->chat_user_id]])->first(),
                'sankougi_chat_thread_joins'         =>  SankougiChatThreadJoin::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
                'sankougi_chat_thread_jobs'          =>  SankougiChatThreadJob::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
            ]);
        }
        else
        {
            return redirect()->route('Home.sankougichat.thread');
        }
    }

    // スレッドチャンネル選択画面
    public function showSankougiChatThreadChannel($name_id, $sankougi_chat_thread_id, $sankougi_chat_thread_category_id, $sankougi_chat_thread_channel_id)
    {
        $sankougi_chat_user = SankougiChatUser::where([
            ['name_id', '=', $name_id],
            ['user_id', '=', Auth::id()],
        ])->first();
        // 参加済みのスレッドかのチェック
        if(!$sankougi_chat_user)
        {
            return redirect()->route('Home.sankougichat.thread');
        }
        // 指定されたチャンネルID内のチャットデータを格納する
        $sankougi_chat_thread_channel_chats = SankougiChatThreadChannelChat::where('sankougi_chat_thread_channel_id', '=', $sankougi_chat_thread_channel_id)->get();
        // チャットデータ内のユーザデータを格納する
        $sankougi_chat_thread_channel_chat_users = collect();
        foreach($sankougi_chat_thread_channel_chats as $sankougi_chat_thread_channel_chat)
        {
            $user = SankougiChatUser::where('chat_user_id', '=', $sankougi_chat_thread_channel_chat->chat_user_id)->first();
            $sankougi_chat_thread_channel_chat_users->push($user);
        }
        // パラメータ付きリンクを生成する
        $sankougi_chat_thread_channel_chat_link = route('Home.sankougichat.thread.channel', [
            'name_id'                          =>  $name_id,
            'sankougi_chat_thread_id'          =>  $sankougi_chat_thread_id,
            'sankougi_chat_thread_category_id' =>  $sankougi_chat_thread_category_id,
            'sankougi_chat_thread_channel_id'  =>  $sankougi_chat_thread_channel_id,
            'sankougi_chat_thread_joins'       =>  SankougiChatThreadJoin::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
            'sankougi_chat_thread_jobs'        =>  SankougiChatThreadJob::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
        ]);

        return view('Home.SankougiChat.sankougichat_thread_category', [
            'sankougi_chat_none_user'                 =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_user'                      =>  $sankougi_chat_user,
            'sankougi_chat_users'                     =>  SankougiChatUser::get(),
            'sankougi_chat_thread'                    =>  SankougiChatThread::where('id', '=', $sankougi_chat_thread_id)->first(),
            'sankougi_chat_thread_category'           =>  $sankougi_chat_thread_category_id,
            'sankougi_chat_thread_categorys'          =>  SankougiChatThreadCategory::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
            'sankougi_chat_thread_channels'           =>  SankougiChatThreadChannel::get(),
            'sankougi_chat_thread_channel_id'         =>  $sankougi_chat_thread_channel_id,
            'sankougi_chat_thread_channel_title'      =>  SankougiChatThreadChannel::where('id', '=', $sankougi_chat_thread_channel_id)->first()->title,
            'sankougi_chat_thread_channel_chats'      =>  $sankougi_chat_thread_channel_chats,
            'sankougi_chat_thread_channel_chat_users' =>  $sankougi_chat_thread_channel_chat_users,
            'sankougi_chat_thread_channel_chat_link'  =>  $sankougi_chat_thread_channel_chat_link,
            'sankougi_chat_thread_joins'              =>  SankougiChatThreadJoin::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
            'sankougi_chat_thread_jobs'               =>  SankougiChatThreadJob::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get(),
            'sankougi_chat_thread_job'                =>  SankougiChatThreadJob::where([['sankougi_chat_thread_id', '=', $sankougi_chat_thread_id],['chat_user_id', '=', $sankougi_chat_user->chat_user_id]])->first(),
            'sankougi_chat_stamp_groups'              =>  SankougiChatStampGroup::get(),
            'sankougi_chat_stamps'                    =>  SankougiChatStamp::get(),
        ]);
    }

    // スレッドカテゴリ作成処理 : Fetch
    public function makeSankougiChatThreadCategory(Request $request)
    {
        $sankougi_chat_thread_category = new SankougiChatThreadCategory;
        $sankougi_chat_thread_category->sankougi_chat_thread_id = $request->sankougi_chat_thread_id;
        $sankougi_chat_thread_category->title = '新しいカテゴリ';
        $sankougi_chat_thread_category->save();
    }

    // スレッドカテゴリ更新処理 : Fetch
    public function updateSankougiChatThreadCategory(Request $request)
    {
        SankougiChatThreadCategory::where('id', '=', $request->sankougi_chat_thread_category_id)->update([
            'title' => $request->title,
        ]);
    }

    // スレッドカテゴリ削除処理 : Fetch
    public function deleteSankougiChatThreadCategory(Request $request)
    {
        // カテゴリ配下のチャンネル削除
        SankougiChatThreadChannel::where('sankougi_chat_thread_category_id', '=', $request->sankougi_chat_thread_category_id)->delete();
        // カテゴリ削除
        SankougiChatThreadCategory::where('id', '=', $request->sankougi_chat_thread_category_id)->delete();
    }

    // スレッドチャンネル作成処理 : Fetch
    public function makeSankougiChatThreadChannel(Request $request)
    {
        $sankougi_chat_thread_channel = new SankougiChatThreadChannel;
        $sankougi_chat_thread_channel->sankougi_chat_thread_category_id = $request->sankougi_chat_thread_category_id;
        $sankougi_chat_thread_channel->title = '新しいチャンネル';
        $sankougi_chat_thread_channel->save();
    }

    // スレッドチャンネル更新処理 : Fetch
    public function updateSankougiChatThreadChannel(Request $request)
    {
        SankougiChatThreadChannel::where('id', '=', $request->sankougi_chat_thread_channel_id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }

    // スレッドチャンネル削除処理 : Fetch
    public function deleteSankougiChatThreadChannel(Request $request)
    {
        // カテゴリ配下のチャンネル削除
        SankougiChatThreadChannel::where([
            ['id', '=', $request->sankougi_chat_thread_channel_id],
            ['sankougi_chat_thread_category_id', '=', $request->sankougi_chat_thread_category_id],
        ])->delete();
    }

    // スレッドチャンネルチャット受信処理 : Ajax
    public function getSankougiChatThreadChannelChat(Request $request)
    {
        // DBから指定したチャンネルIDの最新チャットデータを取得する
        $sankougi_chat_thread_channel_chat = SankougiChatThreadChannelChat::where([
            ['sankougi_chat_thread_channel_id', '=', $request->sankougi_chat_thread_channel_id],
            ['id', '=', SankougiChatThreadChannelChat::where('sankougi_chat_thread_channel_id', '=', $request->sankougi_chat_thread_channel_id)->latest()->first()->id],
        ])->first();
        // チャットデータのユーザ情報を取得する
        $sankougi_chat_thread_channel_chat_user = SankougiChatUser::where('chat_user_id', '=', $sankougi_chat_thread_channel_chat->chat_user_id)->first();

        // メッセージの内容とユーザ情報を返す
        return response()->json([
            'name' => $sankougi_chat_thread_channel_chat_user->name,
            'content' => $sankougi_chat_thread_channel_chat->content,
            'stamp' => $sankougi_chat_thread_channel_chat->stamp,
            'image' => $sankougi_chat_thread_channel_chat->image,
            'image_avatar' => $sankougi_chat_thread_channel_chat_user->image_avatar,
            'name_id' => $sankougi_chat_thread_channel_chat_user->name_id,
            'created_at' => $sankougi_chat_thread_channel_chat->created_at->format('Y-m-d H:i'),
            'created_data' => $sankougi_chat_thread_channel_chat->created_at,
        ], 200);
    }

    // スレッドチャンネルチャット送信処理 : Ajax
    public function postSankougiChatThreadChannelChat(Request $request)
    {
        // チャットデータをDBに保存する
        $sankougi_chat_thread_channel_chat = new SankougiChatThreadChannelChat;
        $sankougi_chat_thread_channel_chat->sankougi_chat_thread_channel_id = $request->sankougi_chat_thread_channel_id;
        $sankougi_chat_thread_channel_chat->chat_user_id = SankougiChatUser::where('name_id', '=', $request->name_id)->first()->chat_user_id;
        
        // 画像の保存
        if($request->image)
        {
            $image_path = $request->file('image')->store('public/sankougichat_thread/chat/image/');
            $sankougi_chat_thread_channel_chat->image = basename($image_path);
        }
        // スタンプの保存
        if($request->sankougi_chat_stamp_id)
        {
            $sankougi_chat_thread_channel_chat->content = '###STAMP_DATA###';
            $sankougi_chat_thread_channel_chat->stamp = SankougiChatStamp::where([
                ['sankougi_chat_stamp_group_id', '=', $request->sankougi_chat_stamp_group_id],
                ['id', '=', $request->sankougi_chat_stamp_id],
            ])->first()->image;
        }
        else
        {
            $sankougi_chat_thread_channel_chat->content = $request->content;
        }
        $sankougi_chat_thread_channel_chat->save();

        return response()->json([], 200);
    }

    // スレッド権限編集処理 : Fetch
    public function changeSankougiChatThreadJob(Request $request)
    {
        $sankougi_chat_thread_job = SankougiChatThreadJob::where('id', '=', $request->sankougi_chat_thread_job_id);
        $sankougi_chat_user = SankougiChatUser::where('chat_user_id', '=', $sankougi_chat_thread_job->first()->chat_user_id);
        // 管理者権限剥奪
        if($request->mode == 'remove')
        {
            $sankougi_chat_thread_job->update([
                'admin_flag' => null,
            ]);
            $text = '付与';
            $command = 'give';
        }
        // 管理者権限付与
        else if($request->mode == 'give')
        {
            $sankougi_chat_thread_job->update([
                'admin_flag' => true,
            ]);
            $text = '剥奪';
            $command = 'remove';
        }

        return response()->json([
            'id' => $sankougi_chat_thread_job->first()->id,
            'image_avatar' => $sankougi_chat_user->first()->image_avatar,
            'name' => $sankougi_chat_user->first()->name,
            'text' => $text,
            'command' => $command,
        ], 200);
    }

    // スレッド参加処理
    public function storeSankougiChatThread($name_id, $sankougi_chat_thread_id)
    {
        $sankougi_chat_user = SankougiChatUser::where('name_id', '=', $name_id)->first()->chat_user_id;
        // 新規参加者情報を登録
        $sankougi_chat_thread_join = new SankougiChatThreadJoin;
        $sankougi_chat_thread_join->sankougi_chat_thread_id = $sankougi_chat_thread_id;
        $sankougi_chat_thread_join->chat_user_id = $sankougi_chat_user;
        $sankougi_chat_thread_join->save();
        // 参加者カウントを更新
        $sankougi_chat_thread = SankougiChatThread::where('id', '=', $sankougi_chat_thread_id)->first();
        $sankougi_chat_thread->update([
            'join_count' => $sankougi_chat_thread->join_count + 1,
        ]);
        // スレッドジョブを設定
        $sankougi_chat_thread_job = new SankougiChatThreadJob;
        $sankougi_chat_thread_job->sankougi_chat_thread_id = $sankougi_chat_thread_id;
        $sankougi_chat_thread_job->chat_user_id = $sankougi_chat_user;
        $sankougi_chat_thread_job->save();

        return redirect()->route('Home.sankougichat.thread');
    }

    // スレッド退出処理
    public function deleteSankougiChatThread($name_id, $sankougi_chat_thread_id)
    {
        $sankougi_chat_user = SankougiChatUser::where('name_id', '=', $name_id)->first()->chat_user_id;
        // 管理者が退出する場合
        if(SankougiChatThreadJob::where([
            ['sankougi_chat_thread_id', '=', $sankougi_chat_thread_id],
            ['chat_user_id', '=', $sankougi_chat_user],
            ['admin_flag', '=', true],
        ])->first())
        {
            // 参加者情報削除
            $sankougi_chat_thread_joins = SankougiChatThreadJoin::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get();
            foreach($sankougi_chat_thread_joins as $sankougi_chat_thread_join)
            {
                $sankougi_chat_thread_join->delete();
            }
            // スレッドジョブ削除
            $sankougi_chat_thread_jobs = SankougiChatThreadJob::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get();
            foreach($sankougi_chat_thread_jobs as $sankougi_chat_thread_job)
            {
                $sankougi_chat_thread_job->delete();
            }            
            // スレッド内部情報削除
            $sankougi_chat_thread = SankougiChatThread::where('id', '=', $sankougi_chat_thread_id)->first();
            // 画像の削除
            if($sankougi_chat_thread->image)
            {
                Storage::disk('public')->delete('sankougichat_thread/image/' . $sankougi_chat_thread->image);
            }
            // スレッドカテゴリ削除
            $sankougi_chat_thread_categorys = SankougiChatThreadCategory::where('sankougi_chat_thread_id', '=', $sankougi_chat_thread_id)->get();
            // スレッドチャンネル削除
            foreach($sankougi_chat_thread_categorys as $thread_category)
            {
                $sankougi_chat_thread_channel = SankougiChatThreadChannel::where('sankougi_chat_thread_category_id', '=', $thread_category->id);
                // スレッドチャンネルチャット削除
                SankougiChatThreadChannelChat::where('sankougi_chat_thread_channel_id', '=', $sankougi_chat_thread_channel->first()->id)->delete();
                // スレッドチャンネル削除
                $sankougi_chat_thread_channel->delete();
                // スレッドカテゴリ削除
                $thread_category->delete();
            }

            // スレッドの削除
            $sankougi_chat_thread->delete();
        }
        else
        {
            // 参加者情報削除
            SankougiChatThreadJoin::where([
                ['chat_user_id', '=', $sankougi_chat_user],
                ['sankougi_chat_thread_id', '=', $sankougi_chat_thread_id],
            ])->delete();
            // スレッドジョブ削除
            SankougiChatThreadJob::where([
                ['chat_user_id', '=', $sankougi_chat_user],
                ['sankougi_chat_thread_id', '=', $sankougi_chat_thread_id],
            ])->delete();
            // 参加者カウントを更新
            $sankougi_chat_thread = SankougiChatThread::where('id', '=', $sankougi_chat_thread_id)->first();
            $sankougi_chat_thread->update([
                'join_count' => $sankougi_chat_thread->join_count - 1,
            ]);
        }
        
        return back();
    }

    // 検索画面
    public function showSankougiChatSearch()
    {
        return view('Home.SankougiChat.sankougichat_search', [
            'sankougi_chat_none_user'   =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_users'       =>  SankougiChatUser::get(),
            'sankougi_chats'            =>  SankougiChat::orderBy('good_count', 'desc')->limit(5)->get(),
        ]);
    }

    // 検索処理 : Ajax
    public function sankougichatsearch(Request $request)
    {
        // name_idでの検索
        if($request->mode == 'nameID')
        {
            $results = 0;
            $sankougi_chat_users = SankougiChatUser::where('name_id', 'LIKE', "%{$request->content}%")->get();
        }
        // 投稿検索
        else if($request->mode == 'search')
        {
            $results = SankougiChat::where('content', 'LIKE', "%{$request->content}%")->get();
            $sankougi_chat_users = collect();
            foreach($results as $result)
            {
                $user = SankougiChatUser::where('chat_user_id', '=', $result->chat_user_id)->first();
                $sankougi_chat_users->push($user);
            }
        }

        return response()->json([
            'results' => $results,
            'sankougi_chat_users' => $sankougi_chat_users,
        ], 200);
    }

    // プロフィール画面
    public function showSankougiChatProfile($name_id)
    {
        return view('Home.SankougiChat.sankougichat_profile', [
            'sankougi_chats'             =>  SankougiChat::latest()->get(),
            'sankougi_chat_none_user'    =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_users'        =>  SankougiChatUser::get(),
            'sankougi_chat_user'         =>  SankougiChatUser::where('name_id', '=', $name_id)->first(),
            'sankougi_chat_evaluations' =>  SankougiChatEvaluation::where('user_id', '=', Auth::id())->get(),
            'sankougi_chat_comments'    =>  SankougiChatComment::get(),
            'sankougi_chat_follow_check' =>  SankougiChatFollow::where([['chat_user_name_id', '=', $name_id], ['chat_user_id', '=', SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id]])->first(),
            'sankougi_chat_followers'    =>  SankougiChatFollow::where('chat_user_name_id', '=', $name_id)->get(),
            'sankougi_chat_follows'      =>  SankougiChatFollow::where('chat_user_id', '=', SankougiChatUser::where('name_id', '=', $name_id)->first()->chat_user_id)->get(),
            'name_id'                    =>  $name_id,
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
            Storage::disk('public')->delete('sankougichat_user/header/' . $sankougi_chat_user->first()->image_header);
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
            Storage::disk('public')->delete('sankougichat_user/avatar/' . $sankougi_chat_user->first()->image_avatar);
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

    // フォロー&フォロワー一覧画面
    public function showSankougiChatFollow($name_id, $type)
    {
        return view('Home.SankougiChat.sankougichat_follows', [
            'sankougi_chat_none_user'    =>  SankougiChatUser::where('user_id', '=', Auth::id())->first(),
            'sankougi_chat_users'        =>  SankougiChatUser::get(),
            'sankougi_chat_follow_check' =>  SankougiChatFollow::where([['chat_user_name_id', '=', $name_id], ['chat_user_id', '=', SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id]])->first(),
            'sankougi_chat_followers'    =>  SankougiChatFollow::where('chat_user_name_id', '=', $name_id)->get(),
            'sankougi_chat_follows'      =>  SankougiChatFollow::where('chat_user_id', '=', SankougiChatUser::where('name_id', '=', $name_id)->first()->chat_user_id)->get(),
            'name_id'                    =>  $name_id,
        ]);
    }

    // フォロー登録処理 : Fetch
    public function storeSankougiChatFollow(Request $request)
    {
        // フォローを追加
        $sankougi_chat_follow = new SankougiChatFollow;
        $sankougi_chat_follow->chat_user_name_id = $request->chat_user_name_id;
        $sankougi_chat_follow->chat_user_id = SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id;
        $sankougi_chat_follow->follow_flag = true;
        $sankougi_chat_follow->save();
    }

    // フォロー解除処理 : Fetch
    public function deleteSankougiChatFollow()
    {
        SankougiChatFollow::where('chat_user_id', '=', SankougiChatUser::where('user_id', '=', Auth::id())->first()->chat_user_id)->delete();
    }

    // 検索IDの生成処理
    public function createSankougiChatProfileID()
    {
        do {
            $name_id = Str::random(16); // 16文字のランダムな16進数のIDを生成
        } while (SankougiChatUser::where('name_id', '=', $name_id)->exists());

        return response()->json(['name_id' => $name_id]);
    }
    /************************************************/
    /*                                              */
    /*                  カレンダー                   */
    /*                                              */
    /************************************************/
    // カレンダー画面
    public function showCalendar()
    {
        return view('Home.Calendar.calendar');
    }
}