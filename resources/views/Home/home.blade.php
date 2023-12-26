@extends('Layouts.Default')
@section('title', 'ホーム')
@section('CSS')
<style>
@keyframes gaming {
    to { background-position-x: 200%; }
}

@keyframes arrow-left {
    0% {
        left: -5%;
    }
    50% {
        left: -10%;
    }
    100% {
        left: -5%;
    }
}

@keyframes arrow-right {
    0% {
        right: -5%;
    }
    50% {
        right: -10%;
    }
    100% {
        right: -5%;
    }
}
#CardHover:hover {
    background: rgb(231, 231, 231);
    transition: 0.3s;
}
#QuickAccess:hover {
    background: rgb(231, 231, 231);
    transition: 0.3s;
}

.gaming {
    /* フォントサイズなどを任意で指定する */
    font: bold 10em / 1 Verdana, Helvetica, Arial, sans-serif;
    text-transform: uppercase;
    
    /* 背景グラデーションを指定・幅を 200% にしておく */
    background: linear-gradient(to right, #f00 0%, #f80 14.28%, #dd0 28.56%, #0d0 42.85%, #0dd 57.14%, #00f 71.42%, #e0e 85.71%, #f00 100%) 0% center / 200% auto;
    
    /* 背景画像を文字でマスクする */
            background-clip: text;
    -webkit-background-clip: text;
    
    /* 文字色を透明にできればよく color: transparent でも color: rgba(0, 0, 0, 0) でも可 */
            text-fill-color: transparent;
    -webkit-text-fill-color: transparent;
    
    /* アニメーション指定 */
    animation: gaming 4s linear infinite;
}

.arrow-left:hover {
    animation: arrow-left 1s linear infinite;
}
.arrow-right:hover {
    animation: arrow-right 1s linear infinite;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-0 border-end">
            <div class="p-2 mb-0 h4 border-bottom text-center bg-primary text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg>   クイックアクセス
            </div>
            <ul class="list-group list-group-flush">
                {{-- 学校関連情報 --}}
                <li class="list-group-item p-0">
                    <div class="text-center text-secondary">
                        学校関連情報
                    </div>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="https://misato-th.spec.ed.jp/" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <div class="d-flex">
                            <div class="h5">三郷工業技術高等学校</div>
                            <div class="h5 mx-2 d-lg-block d-md-none">-</div>
                            <div class="text-secondary d-lg-block d-md-none">ホーム</div>
                        </div>
                    </a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="http://www.zenjouken.com/" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <div class="d-flex">
                            <div class="h5">全国情報技術教育研究会</div>
                            <div class="h5 mx-2 d-lg-block d-md-none">-</div>
                            <div class="text-secondary d-lg-block d-md-none">ホーム</div>
                        </div>
                    </a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="https://passnavi.obunsha.co.jp/" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <div class="d-flex">
                            <div class="h5">パスナビ</div>
                            <div class="h5 mx-2 d-lg-block d-md-none">-</div>
                            <div class="text-secondary d-lg-block d-md-none">大学検索</div>
                        </div>
                    </a>
                </li>
                {{-- Googleサービス --}}
                <li class="list-group-item p-0 border-top">
                    <div class="text-center text-secondary">
                        Googleサービス
                    </div>
                </li>
                <li class="list-group-item p-0 border-0">
                    <div class="input-group p-2">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="SearchContent" class="form-control" placeholder="Googleで検索する" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text p-0">
                            <button type="button" id="SearchSubmit" class="btn btn-primary rounded-0 rounded-end" target="_blank">検索</button>
                            <script type="text/javascript">
                                document.getElementById('SearchSubmit').addEventListener('click', () => {
                                    window.open('https://www.google.com/search?q=' + document.getElementById('SearchContent').value);
                                });
                            </script>
                        </span>
                    </div>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="https://classroom.google.com/" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                        </svg>
                        <div class="h5 ms-2">Google Classroom</div>
                    </a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="https://drive.google.com/drive/home" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                        </svg>
                        <div class="h5 ms-2">Google Drive</div>
                    </a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="https://www.youtube.com/" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                        </svg>
                        <div class="h5 ms-2">YouTube</div>
                    </a>
                </li>
                {{-- その他 --}}
                <li class="list-group-item p-0 border-top border-bottom">
                    <div class="text-center text-secondary">
                        その他
                    </div>
                </li>
                {{-- 所在ログ --}}
                <li class="list-group-item p-0 border-0">
                    <a href="#Log" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" onclick="showWindow()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        <div class="h5 ms-2">教員出席状況</div>
                    </a>
                </li>
                {{-- ピックアップ --}}
                <li class="list-group-item p-0 border-0">
                    <a href="#Pickup" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex" data-bs-toggle="modal" data-bs-target="#PickupModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        <div class="h5 ms-2">情報技術科ピックアップ</div>
                        <div id="PickUpPageFlag">
                            @if($pickup_flag)
                                <div class="gaming fs-5 ms-3">New</div>
                            @endif
                        </div>
                    </a>
                </li>
                {{-- ピックアップモーダル --}}
                <div class="modal fade" id="PickupModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    {{-- メニュー --}}
                                    <div class="col-3 border-end">
                                        <div class="list-group">
                                            <div class="list-group-item bg-primary text-light text-center h4 m-0">情報技術科ピックアップ</div>
                                            @foreach($pickups as $pickup)
                                                <button type="button" class="list-group-item list-group-item-action" onclick="ViewPage({{ $pickup->id }});">
                                                    <div class="row">
                                                        {{-- 日付 --}}
                                                        <div class="col-2 p-0 text-center">
                                                            {{ $pickup->created_at->format('Y.m.d') }}
                                                        </div>
                                                        {{-- タイプ --}}
                                                        <div class="col-3">
                                                            <div class="@if($pickup->type == '入試関連') bg-danger @else bg-success @endif px-1 text-center text-light">
                                                                {{ $pickup->type }}
                                                            </div>
                                                        </div>
                                                        {{-- 内容 --}}
                                                        <div class="col-6 text-truncate">
                                                            {{ $pickup->title }}
                                                        </div>
                                                        {{-- 既読確認 --}}
                                                        <div class="col-1 ps-1 text-danger">
                                                            <div id="PickUpPageFlag{{ $pickup->id }}">
                                                                @if(!\App\Models\PickUpRead::where([['pickup_id', '=', $pickup->id], ['user_id', '=', Auth::id()]])->first())
                                                                    New
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- ページ本体 --}}
                                    <div id="TargetContent" class="col-9">
                                        <div class="row">
                                            {{-- ページタイトル --}}
                                            <div class="col-12">
                                                <div class="bg-primary text-light py-2 h4 rounded-top d-flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-newspaper ms-2" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                                    </svg>
                                                    <div id="PickUpPageTitle" class="ms-2"></div>
                                                </div>
                                            </div>
                                            {{-- ページ本体 --}}
                                            <div class="col-12 pt-0">
                                                <img id="PickUpPageImage" src="" width="100%" alt="">
                                                <div class="d-flex mt-2 mb-3 h3">
                                                    <div id="PickUpPageType"></div>
                                                    <div id="PickUpPageHyphen" class="mx-2 text-secondary"></div>
                                                    <div id="PickUpPageDate" class="text-secondary"></div>
                                                </div>
                                                <div id="PickUpPageContent" class="fs-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ようこそ --}}
                <li class="list-group-item p-0 border-0">
                    <a href="@if(Auth::check()){{ route('Profile.account') }} @else {{ route('Auth.login') }} @endif" id="QuickAccess" class="btn border-0 w-100 pt-3 rounded-0 d-flex">
                        @if(Auth::check())
                            <img src="{{ asset('storage/avatar/' . Auth::user()->image) }}" class="rounded-circle border" alt="" width="30px" height="30px">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        @endif
                        <div class="h5 ms-2 @if(Auth::check()) mt-1 pb-2 @endif">
                            @if(Auth::check())
                                ようこそ、{{ Auth::user()->name }}さん
                            @else
                                ログイン
                            @endif
                        </div>
                    </a>
                </li>
            </ul>
            {{-- 入退室ステータス --}}
            @auth
            {{-- 入室済みだったら --}}
                @if(isset($joinout->flag) && !Auth::user()->admin_flag)
                    <div class="position-relative">
                        <div id="JoinOutContent" class="position-absolute w-100 px-4" style="top: 50px">
                            <div class="position-relative">
                                <div class="rounded-3 border @if($joinout->flag) border-dark @endif">
                                    <div class="p-2 @if($joinout->flag) gaming @else bg-secondary text-light rounded-top @endif">
                                        <div class="h5 mx-3">
                                            <div class="text-center border-bottom @if($joinout->flag) border-dark @endif pb-1">現在の入室状況</div>
                                            <div class="text-start pt-1">
                                                @if($joinout->flag)
                                                    {{ $room }}に入室中です
                                                @else
                                                    入室していません
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="@if(!$joinout->flag) bg-secondary rounded-bottom @endif pb-2">
                                        @if($joinout->flag)
                                        <div class="card mx-4">
                                            <div class="card-body text-secondary px-2 py-1">
                                                <div class="fs-6">{{ $joinout->first_date }}～</div>
                                                <div class="fs-6">{{ $joinout->last_date }}</div>
                                            </div>
                                        </div>
                                            <a href="{{ route('Home.joinout.exit') }}" class="btn btn-primary ms-4 mt-2">退出する</a>
                                        @else
                                            <a href="{{ route('Home.joinout') }}" class="btn btn-primary ms-4 mt-2">入室する</a>
                                        @endif
                                    </div>
                                </div>
                                <div id="MoveArrowLeftContent" class="position-absolute arrow-left" style="top: 40%; left: -5%;">
                                    <button type="button" id="MoveLeftArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div id="MoveArrowRightContent" class="position-absolute arrow-right d-none" style="top: 40%; right: -5%;">
                                    <button type="button" id="MoveRightArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- 入室済みだったら(教員) --}}
                @elseif(isset($joinout->flag) && Auth::user()->admin_flag)
                    <div class="position-relative">
                        <div id="JoinOutContent" class="position-absolute w-100 px-4" style="top: 50px">
                            <div class="position-relative">
                                <div class="rounded-3 border @if($joinout->flag) border-dark @endif">
                                    <div class="p-2 @if($joinout->flag) gaming @else bg-secondary text-light rounded-top @endif">
                                        <div class="h5 mx-3">
                                            <div class="text-center border-bottom @if($joinout->flag) border-dark @endif pb-1">現在の入室状況</div>
                                            <div class="text-start pt-1">
                                                @if($joinout->flag)
                                                    出席中です
                                                @else
                                                    退席中です
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="@if(!$joinout->flag) bg-secondary rounded-bottom @endif pb-2">
                                        @if($joinout->flag)
                                            <a href="{{ route('Home.joinout.exit') }}" class="btn btn-primary ms-4 mt-2">退席する</a>
                                        @else
                                            <a href="{{ route('Home.joinout.teacher') }}" class="btn btn-primary ms-4 mt-2">出席する</a>
                                        @endif
                                    </div>
                                </div>
                                <div id="MoveArrowLeftContent" class="position-absolute arrow-left" style="top: 40%; left: -5%;">
                                    <button type="button" id="MoveLeftArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div id="MoveArrowRightContent" class="position-absolute arrow-right d-none" style="top: 40%; right: -5%;">
                                    <button type="button" id="MoveRightArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="position-relative">
                        <div id="JoinOutContent" class="position-absolute w-100 px-4" style="top: 50px">
                            <div class="position-relative">
                                <div class="rounded-3 border">
                                    <div class="p-2 bg-secondary text-light rounded-top">
                                        <div class="h5 mx-3">
                                            <div class="text-center border-bottom pb-1">現在の入室状況</div>
                                            <div class="text-start pt-1">
                                                入室していません
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-secondary rounded-bottom pb-2">
                                        <a href="{{ route('Home.joinout') }}" class="btn btn-primary ms-4 mt-2">入室する</a>
                                    </div>
                                </div>
                                <div id="MoveArrowLeftContent" class="position-absolute arrow-left" style="top: 40%; left: -5%;">
                                    <button type="button" id="MoveLeftArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div id="MoveArrowRightContent" class="position-absolute arrow-right d-none" style="top: 40%; right: -5%;">
                                    <button type="button" id="MoveRightArrow" class="btn border-0 p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
        {{-- サービス一覧 --}}
        <div class="col-10 p-0 bg-light">
            <div class="p-2 h4 border-bottom text-center bg-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hdd-network" viewBox="0 0 16 16">
                    <path d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM3 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8.5v3a1.5 1.5 0 0 1 1.5 1.5h5.5a.5.5 0 0 1 0 1H10A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5H.5a.5.5 0 0 1 0-1H6A1.5 1.5 0 0 1 7.5 10V7H2a2 2 0 0 1-2-2V4zm1 0v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1zm6 7.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5z"/>
                </svg>   サービス一覧
            </div>
            <div class="row px-2">
                {{-- カード --}}
                @php
                    // カードコンテンツ
                    $CardContents = array(
                        array(
                            'Card_Title'  => 'CHaserOnline',
                            'Card_Body'   => 'CHaserOnlineをすべてここに',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/CHaser.jpg'),
                            'Card_Link'   => route('Home.chaser'),
                        ),
                        array(
                            'Card_Title'  => '三工技チャット',
                            'Card_Body'   => 'わからないことを共有しよう!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/SankougiChat.jpg'),
                            'Card_Link'   => route('Home.sankougichat'),
                        ),
                        array(
                            'Card_Title'  => 'ローカルメモ',
                            'Card_Body'   => 'ここだけをメモしよう!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/LocalMemo.jpg'),
                            'Card_Link'   => route('Home.localmemo'),
                        ), 
                        array(
                            'Card_Title'  => 'カレンダー',
                            'Card_Body'   => 'Googleカレンダーとも連携!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/Calender.jpg'),
                            'Card_Link'   => route('Home.calendar'),
                        ),
                        array(
                            'Card_Title'  => '入退室フォーム',
                            'Card_Body'   => '実習室の利用はこちらより',
                            'Card_Date'   => '最終更新日: 2023年12月05日',
                            'Card_Image'  => asset('Home/Images/JoinOut.jpg'),
                            'Card_Link'   => route('Home.joinout'),
                        ),
                        array(
                            'Card_Title'  => 'クリエイターツール',
                            'Card_Body'   => 'あなたの創造に手助けを',
                            'Card_Date'   => '最終更新日: 2023年12月12日',
                            'Card_Image'  => asset('Home/Images/CreaterTool.jpg'),
                            'Card_Link'   => route('Home.creatertool'),
                        )
                    );
                @endphp
                @foreach($CardContents as $CardContent)
                    <div class="col-12 col-md-4">
                        <a class="text-decoration-none" href="{{ $CardContent['Card_Link'] }}">
                            <div id="CardHover" class="card mb-3 w-100">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="border-end">
                                            <img src="{{ $CardContent['Card_Image'] }}" class="img-fluid rounded-start" alt="...">
                                        </div>                           
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $CardContent['Card_Title'] }}</h4>
                                            <p class="card-text">{{ $CardContent['Card_Body'] }}</p>
                                            <p class="card-text"><small class="text-body-secondary">{{ $CardContent['Card_Date'] }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{-- ゲーム一覧 --}}
                <div class="col-12 p-0" style="margin-left: 3px;">
                    <div class="p-2 h4 border-top border-bottom text-center bg-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-controller" viewBox="0 0 16 16">
                            <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
                            <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
                        </svg>   ゲーム一覧
                    </div>
                </div>
                {{-- カード --}}
                @php
                    // カードコンテンツ
                    $CardContents = array(
                        array(
                            'Card_Title'  => 'ナンプレ',
                            'Card_Body'   => 'ナンプレを遊べるよ！',
                            'Card_Date'   => '最終更新日: 2023年12月05日',
                            'Card_Image'  => asset('Game/NumberPlate/Images/sudoku.png'),
                            'Card_Link'   => route('Game.numberplate'),
                        ),
                    );
                @endphp
                @foreach($CardContents as $CardContent)
                    <div class="col-12 col-md-4">
                        <a class="text-decoration-none" href="{{ $CardContent['Card_Link'] }}">
                            <div id="CardHover" class="card mb-3 w-100">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="border-end">
                                            <img src="{{ $CardContent['Card_Image'] }}" class="img-fluid rounded-start" alt="...">
                                        </div>                           
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $CardContent['Card_Title'] }}</h4>
                                            <p class="card-text">{{ $CardContent['Card_Body'] }}</p>
                                            <p class="card-text"><small class="text-body-secondary">{{ $CardContent['Card_Date'] }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="text/javascript">
    @if(session('message'))
        alert('{{ session('message') }}');
    @endif
</script>
<script type="text/javascript">
    function ViewPage(id) {
        const TargetContent = document.getElementById('TargetContent');
        // 元の表示を格納する
        var TargetBackUp = TargetContent.innerHTML;
        // 読み込み表示に変更する
        TargetContent.innerHTML = `
            <div class="position-relative">
                <div class="spinner-border position-absolute" style="width: 3rem; height: 3rem; top: 300px; left: 50%;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        // 既読に変更する
        document.getElementById('PickUpPageFlag' + id).innerHTML = "";
        fetch('', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
            }),
        })
        .then((response) => response.json())
        .then(res => {
            // 元の表示に戻す
            TargetContent.innerHTML = TargetBackUp;
            document.getElementById('PickUpPageTitle').innerHTML = res.title;
            document.getElementById('PickUpPageImage').src = '{{ asset('storage/pickup') }}' + '/' + res.image;
            document.getElementById('PickUpPageType').innerHTML = res.type;
            document.getElementById('PickUpPageContent').innerHTML = res.content.replace(/\r?\n/g, '<br>');
            document.getElementById('PickUpPageHyphen').innerHTML = "-";
            document.getElementById('PickUpPageDate').innerHTML = res.created_at;
            if(res.flag) {
                document.getElementById('PickUpPageFlag').innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error);
        });
    }
</script>
<script type="text/javascript">
    const max_left = "-85%";
    document.getElementById('MoveLeftArrow').addEventListener('click', () => {
        document.getElementById('JoinOutContent').animate({
            left: ["0px", max_left],
        }, 200);
        document.getElementById('JoinOutContent').style.left = max_left;
        document.getElementById('MoveArrowRightContent').classList.remove("d-none");
    });
    document.getElementById('MoveRightArrow').addEventListener('click', () => {
        document.getElementById('JoinOutContent').animate({
            left: [max_left, "0px"],
        }, 200);
        document.getElementById('JoinOutContent').style.left = '0px';
        document.getElementById('MoveArrowRightContent').classList.add("d-none");
    });
</script>
<script type="text/javascript" src="https://riversun.github.io/jsframe/jsframe.js"></script>
<script type="text/javascript">
    var WindowFlag = true;
    const x = window.innerWidth / 2;
    const y = window.innerHeight / 2;
    const align = 'CENTER_CENTER';
    const jsFrame = new JSFrame();
    const frame = jsFrame.create({
        width: 960, height: 480,
        movable: true,//マウスで移動可能
        resizable: true,//マウスでリサイズ可能
        @auth
        url: '{{ route('Home.joinout.iframe.teacher') }}',
        @endauth
        @guest
        html: `
            <div class="text-center mt-5">
                <div class="h5">ログインしてください</div>
                <a href="{{ route('Auth.login') }}" class="btn btn-success">ログイン</a>
            </div>
        `,
        @endguest
    });

    frame.setPosition(x, y, align);

    function showWindow() {
        if(WindowFlag) {
            frame.show();
            WindowFlag = false;
        } else {
            frame.hide();
            WindowFlag = true;
        }  
    } 
</script>
@endsection