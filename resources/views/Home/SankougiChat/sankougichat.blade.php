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
                @if(!$sankougi_chat_user)
                    <div class="opacity-50" style="-ms-filter: blur(4px); filter: blur(4px);">
                @endif
                    <div class="list-group list-group-flush mt-3">
                        {{-- 掲示板ホーム --}}
                        <a @if($sankougi_chat_user) href="#" @endif class="list-group-item list-group-item-action h4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                            </svg>   掲示板ホーム
                        </a>
                        {{-- スレッド --}}
                        <a @if($sankougi_chat_user) href="#" @endif class="list-group-item list-group-item-action h4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>   スレッド
                        </a>
                        {{-- 検索 --}}
                        <a @if($sankougi_chat_user) href="#" @endif class="list-group-item list-group-item-action h4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>   検索する
                        </a>
                        {{-- 友だちリスト --}}
                        <a @if($sankougi_chat_user) href="#" @endif class="list-group-item list-group-item-action h4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg>   友だちリスト
                        </a>
                        {{-- 投稿ボタン --}}
                        <button class="btn btn-primary mt-5 mx-2" @if(!$sankougi_chat_user) disabled @endif>
                            <div class="fs-5">
                                投稿する
                            </div>
                        </button>
                    </div>
                {{-- 三工技プロフィール未登録 --}}
                @if(!$sankougi_chat_user)
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



        {{-- ≦768px --}}
        {{-- 左側コンテンツ --}}
        <div class="col-2 d-md-none position-fixed" style="left: 0;">
            
        </div>



        {{-- 中央コンテンツ --}}
        <div class="col-10 col-md-9 overflow-auto position-absolute bg-light border-start overflow-x-hidden" style="right: 0;">
            <div class="row">
                {{-- 投稿カード --}}
                {{-- @foreach($sankougi_chats as $sankougi_chat) --}}
                <div class="col-12">
                    <div class="border-bottom px-3">
                        <div class="card w-75 mx-auto my-3 border-0">
                            <div class="card-header border-0 bg-light">
                                ヘッダー
                            </div>
                            <div class="card-body">
                                ボディ
                            </div>
                            <div class="card-footer border-0 bg-light">
                                フッター
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>




    </div>
    {{-- 投稿ボタン2 --}}
    @if($sankougi_chat_user)
    <div id="elm" class="btn btn-primary position-fixed" style="right: 10px; bottom: 10px; display: none;">
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
                $("#elm").show();
            } else {
                $("#elm").hide();
            }
        });

        $(window).on('scroll', function() {
            if ($(window).scrollTop() === 0) {
                $("#elm").hide();
            }
        });
    });
</script>
@endsection