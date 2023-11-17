@extends('Layouts.Default')
@section('title', '三工技チャット')
@section('content')
<div class="container-fluid">
    <div id="row">
        {{-- ≧768px --}}
        {{-- 左側コンテンツ --}}
        <div class="col-md-3 d-none d-md-block position-fixed" style="left: 0;">
            {{-- ログイン済み --}}
            @auth
                @if(!isset($sankougi_chat_none_user))
                    <div class="opacity-50" style="-ms-filter: blur(4px); filter: blur(4px);">
                @endif
                <div class="list-group list-group-flush mt-3">
                    {{-- 掲示板ホーム --}}
                    <a @if(isset($sankougi_chat_none_user))href="{{ route('Home.sankougichat') }}"@endif class="list-group-item h4 @if(Request::is('sankougichat') || Request::is('sankougichat/pickup/*')) list-group-item-secondary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                            <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                        </svg>   掲示板ホーム
                    </a>
                    {{-- スレッド --}}
                    <a @if(isset($sankougi_chat_none_user))href="{{ route('Home.sankougichat.thread') }}"@endif class="list-group-item h4 @if(Request::is('sankougichat/thread')) list-group-item-secondary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>   スレッド
                    </a>
                    {{-- 検索 --}}
                    <a @if(isset($sankougi_chat_none_user))href="#"@endif class="list-group-item h4 @if(Request::is('sankougichat/a')) list-group-item-secondary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>   検索する
                    </a>
                    {{-- 友だちリスト --}}
                    <a @if(isset($sankougi_chat_none_user))href="#"@endif class="list-group-item h4 @if(Request::is('sankougichat/a')) list-group-item-secondary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>   友だちリスト
                    </a>
                    {{-- プロフィール --}}
                    <a @if(isset($sankougi_chat_none_user))href="{{ route('Home.sankougichat.profile', $sankougi_chat_none_user->name_id) }}"@endif class="list-group-item h4 @if(Request::is('sankougichat/profile/*')) list-group-item-secondary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
                        </svg>   プロフィール
                    </a>
                   
                    {{-- 投稿ボタン --}}
                    <button class="btn btn-primary mt-5 mx-2" data-bs-toggle="modal" data-bs-target="#PostModal" @if(!isset($sankougi_chat_none_user)) disabled @endif>
                        <div class="fs-5">投稿する</div>
                    </button>
                </div>
                {{-- 三工技プロフィール未登録 --}}
                @if(!isset($sankougi_chat_none_user))
                    </div>
                    <div class="text-center position-fixed" style="top: 350px; left: 6%;">
                        <p class="text-secandary mb-1">三工技チャットをはじめる</p>
                        <a href="{{ route('Home.sankougichat.profile.adduser')}}" class="btn btn-success">
                            三工技チャットプロフィールを作る
                        </a>
                    </div>
                @endif
            @endauth
            {{-- 未ログイン --}}
            @guest
                <div class="text-center" style="margin-top: 80%;">
                    <p class="text-secandary mb-1">三工技チャットを利用するにはログインが必要です</p>
                    <a href="{{ route('Auth.login') }}" class="btn btn-primary">
                        ログイン
                    </a>
                </div>
            @endguest
        </div>
        {{-- 投稿モーダル --}}
        @if(isset($sankougi_chat_none_user))
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal fade" id="PostModal" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header p-1 border-0">
                                    <div class="text-start pt-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="{{ asset('storage/sankougichat_user/avatar/'. $sankougi_chat_none_user->image_avatar) }}" class="rounded-circle border w-100" alt="">
                                        </div>
                                        <div class="col-10">
                                            <textarea type="text" class="form-control" name="content" rows="5" style="resize: none;" placeholder="いまどうしてる？" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <input type="file" name="image">
                                    <button type="submit" class="btn btn-primary">投稿する</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form> 
        @endif
        


        
        {{-- ≦768px --}}
        {{-- 左側コンテンツ --}}
        <div class="col-2 d-md-none position-fixed" style="left: 0;">
            
        </div>



        {{-- 中央コンテンツ --}}
        <div class="col-10 col-md-9 overflow-auto position-absolute bg-light border-start overflow-x-hidden" style="right: 0;">
            <div class="row">
                <div class="col-12">
                    @yield('view')
                </div>
                @if(Request::is('sankougichat'))
                    {{-- 投稿カード --}}
                    @foreach($sankougi_chats as $sankougi_chat)
                        <div class="col-9">
                            <div class="border-bottom">
                                <div class="card w-75 mx-auto my-3 border-0">
                                    <div class="card-header border-0 p-0 bg-light">
                                        @foreach($sankougi_chat_users as $user)
                                            @if($user->user_id == $sankougi_chat->chat_user_id)
                                                <div class="d-flex">
                                                    <a href="{{ route('Home.sankougichat.profile', $user->name_id) }}">
                                                        <img src="{{ asset('storage/sankougichat_user/avatar/' . $user->image_avatar)}}" class="rounded-circle" alt="" width="40px">
                                                    </a>
                                                    {{-- 投稿時間 --}}
                                                    <div class="d-flex mt-2 ms-2">
                                                        <div class="me-2 h5">{{ $user->name}}</div>
                                                        <div class="text-secondary">
                                                            @php
                                                                $interval = \Carbon\Carbon::now()->diff($sankougi_chat->created_at);
                                                            @endphp
                                                            @if($interval->y != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->y . '年前' }}
                                                            @elseif($interval->m != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->m . 'ヶ月前' }}
                                                            @elseif($interval->d != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->d . '日前' }}
                                                            @elseif($interval->h != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->h . '時間前' }}
                                                            @elseif($interval->i != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->i . '分前' }}
                                                            @elseif($interval->s != 0)
                                                                {{ '@' . $user->name_id . '・' . $interval->s . '秒前' }}
                                                            @else
                                                                {{ '@' . $user->name_id . '・1秒前' }}
                                                            @endif
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- 投稿本体 --}}
                                    @foreach($sankougi_chat_users as $user)
                                        @if($user->user_id == $sankougi_chat->chat_user_id)
                                            <a href="{{ route('Home.sankougi.pickup', [
                                                'name_id' => $user->name_id,
                                                'chat_id' => $sankougi_chat->chat_id,
                                            ]) }}" class="btn border-0 p-0 m-0 text-start">
                                                <div class="card-body">
                                                    <div class="my-1">
                                                        {!! nl2br(htmlspecialchars($sankougi_chat->content)) !!}
                                                    </div>
                                                    @if($sankougi_chat->image)
                                                        <img src="{{ asset('storage/sankougichat/post/'. $sankougi_chat->image) }}" class="rounded" alt="" width="100%">
                                                    @endif
                                                </div>
                                            </a>
                                            @break
                                        @endif
                                    @endforeach
                                    {{-- 投稿評価 --}}
                                    <div class="card-footer border-0 pb-0 bg-light">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="row">
                                                    {{-- コメント --}}
                                                    <div class="col">
                                                        <div class="d-flex">
                                                            <button class="btn border-0 p-0 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.39-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                                </svg>
                                                            </button>
                                                            <div class="ms-1">
                                                                @php
                                                                    $i = 0;
                                                                    foreach($sankougi_chat_comments as $sankougi_chat_comment)
                                                                    {
                                                                        if($sankougi_chat_comment->chat_id == $sankougi_chat->chat_id)
                                                                        {
                                                                            $i++;
                                                                        }
                                                                    }
                                                                @endphp
                                                                {{ $i }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- いいね数 --}}
                                                    <div class="col">
                                                        <div class="d-flex">
                                                            <button id="goodButton-{{ $sankougi_chat->chat_id }}" class="btn border-0 p-0 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                                </svg>
                                                            </button>
                                                            <div id="goodCount-{{ $sankougi_chat->chat_id }}" class="ms-1">
                                                                {{ $sankougi_chat->good_count ?? 0 }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- わるい数 --}}
                                                    <div class="col">
                                                        <div class="d-flex">
                                                            <button id="badButton-{{ $sankougi_chat->chat_id }}" class="btn border-0 p-0 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" id="badButton" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                                    <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                                                                </svg>
                                                            </button>
                                                            <div id="badCount-{{ $sankougi_chat->chat_id }}" class="ms-1">
                                                                {{ $sankougi_chat->bad_count ?? 0 }}
                                                            </div>
                                                        </div>
                                                        {{-- いいねとわるい処理 --}}
                                                        @if(isset($sankougi_chat_none_user))
                                                            <script type="text/javascript">
                                                                //{{-- いいね変数 --}}
                                                                const WholeButton_{{ $sankougi_chat->chat_id }} = document.getElementById("goodButton-{{ $sankougi_chat->chat_id }}");
                                                                const ActionCount_{{ $sankougi_chat->chat_id }} = document.getElementById("goodCount-{{ $sankougi_chat->chat_id }}");
                                                                var ChangeFlag_{{ $sankougi_chat->chat_id }} = false;
                                                                var ChangeNumber_{{ $sankougi_chat->chat_id }} = false;
                                                                //{{-- わるい変数 --}}
                                                                const WholeButton_{{ $sankougi_chat->chat_id . 0 }} = document.getElementById("badButton-{{ $sankougi_chat->chat_id }}");
                                                                const ActionCount_{{ $sankougi_chat->chat_id . 0 }} = document.getElementById("badCount-{{ $sankougi_chat->chat_id }}");
                                                                var ChangeFlag_{{ $sankougi_chat->chat_id . 0 }} = false;
                                                                var ChangeNumber_{{ $sankougi_chat->chat_id . 0 }} = false;
                                                                //{{-- いいねDB --}}
                                                                @foreach($sankougi_chat_evaluations as $sankougi_chat_evaluation)
                                                                    //{{-- DBに登録済み --}}
                                                                    @if($sankougi_chat_evaluation->chat_id == $sankougi_chat->chat_id && $sankougi_chat_evaluation->user_id == Auth::id() && $sankougi_chat_evaluation->good_flag)
                                                                        ChangeFlag_{{ $sankougi_chat->chat_id }} = true;
                                                                        ChangeNumber_{{ $sankougi_chat->chat_id }} = true;
                                                                        //{{-- 登録済みの場合のアイコンに置換する --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16"><path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/></svg>';
                                                                        //{{-- わるいボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.disabled = true;
                                                                        @break
                                                                    //{{-- DBに未登録 --}}
                                                                    @else
                                                                        ChangeFlag_{{ $sankougi_chat->chat_id }} = false;
                                                                        ChangeNumber_{{ $sankougi_chat->chat_id }} = false;
                                                                    @endif
                                                                @endforeach
                                                                //{{-- わるいDB --}}
                                                                @foreach($sankougi_chat_evaluations as $sankougi_chat_evaluation)
                                                                    //{{-- DBに登録済み --}}
                                                                    @if($sankougi_chat_evaluation->chat_id == $sankougi_chat->chat_id && $sankougi_chat_evaluation->user_id == Auth::id() && $sankougi_chat_evaluation->bad_flag)
                                                                        ChangeFlag_{{ $sankougi_chat->chat_id . 0 }} = true;
                                                                        ChangeNumber_{{ $sankougi_chat->chat_id . 0 }} = true;
                                                                        //{{-- 登録済みの場合のアイコンに置換する --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16"><path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/></svg>';
                                                                        //{{-- いいねボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.disabled = true;
                                                                        @break
                                                                    //{{-- DBに未登録 --}}
                                                                    @else
                                                                        ChangeFlag_{{ $sankougi_chat->chat_id . 0 }} = false;
                                                                        ChangeNumber_{{ $sankougi_chat->chat_id . 0 }} = false;
                                                                    @endif
                                                                @endforeach

                                                                //{{-- いいねボタン --}}
                                                                WholeButton_{{ $sankougi_chat->chat_id }}.addEventListener("click", function () {
                                                                    //{{-- 既に押されている場合、解除時の数値を登録する --}}
                                                                    if(ChangeNumber_{{ $sankougi_chat->chat_id }}) {
                                                                        var ActionCountNumber = {{ $sankougi_chat->good_count }} - 1;
                                                                    //{{-- 未登録の場合、現在の値を登録する --}}
                                                                    } else {
                                                                        var ActionCountNumber = {{ $sankougi_chat->good_count ?? 0 }};
                                                                    }
                                                                    //{{-- 既に押されている場合 --}}
                                                                    if(ChangeFlag_{{ $sankougi_chat->chat_id }})
                                                                    {
                                                                        //{{-- わるいボタンの有効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0}}.disabled = false;
                                                                        //{{-- ボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.disabled = true;
                                                                        //{{-- アイコンの置換 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16"><path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/></svg>';
                                                                        //{{-- 数値を減算して置換 --}}
                                                                        ActionCount_{{ $sankougi_chat->chat_id }}.innerHTML = ActionCountNumber;
                                                                        //{{-- Fetchで送信 --}}
                                                                        send_{{ $sankougi_chat->chat_id }}(ActionCountNumber);

                                                                        //{{-- スパム対策 --}}
                                                                        setTimeout(function() {
                                                                            // ボタンの有効化 --}}
                                                                            WholeButton_{{ $sankougi_chat->chat_id }}.disabled = false;
                                                                            ChangeFlag_{{ $sankougi_chat->chat_id }} = false;
                                                                        }, 500);
                                                                    //{{-- まだ押されていない場合 --}}
                                                                    } else {
                                                                        //{{-- わるいボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0}}.disabled = true;
                                                                        //{{-- ボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.disabled = true;
                                                                        //{{-- アイコンの置換 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16"><path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/></svg>';
                                                                        //{{-- 数値を加算して置換 --}}
                                                                        ActionCount_{{ $sankougi_chat->chat_id }}.innerHTML = ActionCountNumber = ActionCountNumber + 1;
                                                                        //{{-- Fetchで送信 --}}
                                                                        send_{{ $sankougi_chat->chat_id }}(ActionCountNumber);

                                                                        //{{-- スパム対策 --}}
                                                                        setTimeout(function() {
                                                                            //{{-- ボタンの有効化 --}}
                                                                            WholeButton_{{ $sankougi_chat->chat_id }}.disabled = false;
                                                                            ChangeFlag_{{ $sankougi_chat->chat_id }} = true;
                                                                        }, 500);
                                                                    }
                                                                });

                                                                //{{-- Fetch いいねのみ --}}
                                                                function send_{{ $sankougi_chat->chat_id }}(e) {
                                                                    console.log(e);
                                                                    fetch('{{ route('Home.sankougichat.evaluation') }}', {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                                            'Content-Type': 'application/json',
                                                                        },
                                                                        body: JSON.stringify({
                                                                            //{{-- 押したユーザーID --}}
                                                                            user_id: {{ Auth::id() }},
                                                                            //{{-- 押したチャットID --}}
                                                                            chat_id: {{ $sankougi_chat->chat_id }},
                                                                            //{{-- good_flagはControllerで適用 --}}
                                                                            //{{-- 演算結果の数 --}}
                                                                            good_count: e + 1,
                                                                        }),
                                                                    })
                                                                    .catch(error => {
                                                                        console.log(error);
                                                                    });
                                                                }

                                                                

                                                                //{{-- わるいボタン --}}
                                                                WholeButton_{{ $sankougi_chat->chat_id . 0 }}.addEventListener("click", function () {
                                                                    //{{-- 既に押されている場合、解除時の数値を登録する --}}
                                                                    if(ChangeNumber_{{ $sankougi_chat->chat_id . 0 }}) {
                                                                        var ActionCountNumber = {{ $sankougi_chat->bad_count }} - 1;
                                                                    //{{-- 未登録の場合、現在の値を登録する --}}
                                                                    } else {
                                                                        var ActionCountNumber = {{ $sankougi_chat->bad_count ?? 0 }};
                                                                    }
                                                                    //{{-- 既に押されている場合 --}}
                                                                    if(ChangeFlag_{{ $sankougi_chat->chat_id . 0 }})
                                                                    {
                                                                        //{{-- いいねボタンの有効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.disabled = false;
                                                                        //{{-- ボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.disabled = true;
                                                                        //{{-- アイコンの置換 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" id="badButton" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16"><path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/></svg>';
                                                                        //{{-- 数値を減算して置換 --}}
                                                                        ActionCount_{{ $sankougi_chat->chat_id . 0 }}.innerHTML = ActionCountNumber;
                                                                        //{{-- Fetchで送信 --}}
                                                                        send_{{ $sankougi_chat->chat_id . 0 }}(ActionCountNumber);

                                                                        // スパム対策
                                                                        setTimeout(function() {
                                                                            //{{-- ボタンの有効化 --}}
                                                                            WholeButton_{{ $sankougi_chat->chat_id . 0 }}.disabled = false;
                                                                            ChangeFlag_{{ $sankougi_chat->chat_id . 0 }} = false;
                                                                        }, 500);
                                                                    //{{-- まだ押されていない場合 --}}
                                                                    } else {
                                                                        //{{-- いいねボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id }}.disabled = true;
                                                                        //{{-- ボタンの無効化 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.disabled = true;
                                                                        //{{-- アイコンの置換 --}}
                                                                        WholeButton_{{ $sankougi_chat->chat_id . 0 }}.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16"><path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/></svg>';
                                                                        //{{-- 数値を加算して置換 --}}
                                                                        ActionCount_{{ $sankougi_chat->chat_id . 0 }}.innerHTML = ActionCountNumber = ActionCountNumber + 1;
                                                                        //{{-- Fetchで送信 --}}
                                                                        send_{{ $sankougi_chat->chat_id . 0 }}(ActionCountNumber);

                                                                        //{{-- スパム対策 --}}
                                                                        setTimeout(function() {
                                                                            //{{-- ボタンの有効化 --}}
                                                                            WholeButton_{{ $sankougi_chat->chat_id . 0 }}.disabled = false;
                                                                            ChangeFlag_{{ $sankougi_chat->chat_id . 0 }} = true;
                                                                        }, 500);
                                                                    }
                                                                });

                                                                //{{-- Fetch わるいのみ --}}
                                                                function send_{{ $sankougi_chat->chat_id . 0 }}(e) {
                                                                    fetch('{{ route('Home.sankougichat.evaluation') }}', {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                                            'Content-Type': 'application/json',
                                                                        },
                                                                        body: JSON.stringify({
                                                                            //{{-- 押したユーザーID --}}
                                                                            user_id: {{ Auth::id() }},
                                                                            //{{-- 押したチャットID --}}
                                                                            chat_id: {{ $sankougi_chat->chat_id }},
                                                                            //{{-- bad_flagはControllerで適用 --}}
                                                                            //{{-- 演算結果の数 --}}
                                                                            bad_count: e + 1,
                                                                        }),
                                                                    })
                                                                    .catch(error => {
                                                                        console.log(error);
                                                                    });
                                                                }
                                                            </script>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            
                        </div>
                    @endforeach
                @endif
            </div>
        </div>




    </div>
    {{-- 投稿ボタン2 --}}
    @if(isset($sankougi_chat_none_user))
        <div id="elm" class="btn btn-primary position-fixed" style="right: 10px; bottom: 10px; display: none;" data-bs-toggle="modal" data-bs-target="#PostModal" @if(!isset($sankougi_chat_user)) disabled @endif>
            <div class="h3 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-sticky-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zm6 8.5a1 1 0 0 1 1-1h4.396a.25.25 0 0 1 .177.427l-5.146 5.146a.25.25 0 0 1-.427-.177V9.5z"/>
                </svg>  投稿する
            </div>
        </div>
    @endif
</div>
@endsection
@section('jQuery')
<script type="module">
    $(document).ready(function() {
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 50) {
                $("#elm").fadeIn();
            } else {
                $("#elm").fadeOut();
            }
        });

        $(window).on('scroll', function() {
            if ($(window).scrollTop() === 0) {
                $("#elm").fadeOut();
            }
        });
    });
</script>
@endsection