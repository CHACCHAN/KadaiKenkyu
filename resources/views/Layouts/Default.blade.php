<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('Layouts/Images/favicon.ico') }}">
    {{-- Vite --}}
    @vite('resources/sass/app.scss')
    {{-- Cropper --}}
    <link rel="stylesheet" href="{{ asset('Layouts/CSS/cropper.min.css') }}">
    {{-- CSS --}}
    <style>
        #Hover:hover {
            color: gray;
        }
    </style>
    @yield('CSS')
</head>
<body id="body" style="overflow-x: hidden;">
{{-- ヘッダー --}}
<header>
<div class="container-fluid p-0 border-bottom">
    <div class="bg-light">
        <div class="row">
            {{-- 左グリッド --}}
            <div class="col-4">
                {{-- キャンバスボタン --}}
                <button id="Hover" class="btn border-0 my-1 text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16" data-bs-toggle="offcanvas" data-bs-target="#SideMenuCanvas" aria-controls="offcanvasWithBothOptions">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
                {{-- キャンバス --}}
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="SideMenuCanvas" aria-labelledby="SideMenuCanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="SideMenuCanvasLabel">
                            <a class="navbar-brand" href="{{ route('Home.home') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                                    <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
                                </svg>   C-SYSTEM
                            </a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-1">
                        <div class="list-group">
                            @php
                                $BasicMenus = array(
                                    array(
                                        'ListTitle' => 'ホーム',
                                        'ListLink'  => route('Home.home'),
                                    ),
                                );
                            @endphp
                            <div class="h5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>   基本メニュー
                            </div>
                            @foreach($BasicMenus as $BasicMenu)
                                <a href="{{ $BasicMenu['ListLink'] }}" class="list-group-item list-group-item-action border-0 border-bottom h5 pb-0">
                                    {{ $BasicMenu['ListTitle'] }}
                                </a>
                            @endforeach

                            @php
                                $ServiceMenus = array(
                                    array(
                                        'ListTitle' => 'CHaserOnline',
                                        'ListLink'  => route('Home.chaser'),
                                    ),
                                    array(
                                        'ListTitle' => '三工技チャット',
                                        'ListLink'  => route('Home.sankougichat'),
                                    ),
                                    array(
                                        'ListTitle' => 'ローカルメモ',
                                        'ListLink'  => route('Home.localmemo'),
                                    ),
                                    array(
                                        'ListTitle' => 'カレンダー',
                                        'ListLink'  => route('Home.calendar'),
                                    ),
                                    array(
                                        'ListTitle' => '入退室フォーム',
                                        'ListLink'  => route('Home.joinout'),
                                    ),
                                    array(
                                        'ListTitle' => 'クリエイターツール',
                                        'ListLink'  => route('Home.creatertool'),
                                    ),
                                );
                            @endphp
                            <div class="h5 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>   サービス
                            </div>
                            @foreach($ServiceMenus as $ServiceMenu)
                                <a href="{{ $ServiceMenu['ListLink'] }}" class="list-group-item list-group-item-action border-0 border-bottom h5 pb-0">
                                    {{ $ServiceMenu['ListTitle'] }}
                                </a>
                            @endforeach

                            @php
                                $GameMenus = array(
                                    array(
                                        'ListTitle' => 'ナンプレ',
                                        'ListLink'  => route('Game.numberplate'),
                                    ),
                                );
                            @endphp
                            <div class="h5 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>   ゲーム
                            </div>
                            @foreach($GameMenus as $GameMenu)
                                <a href="{{ $GameMenu['ListLink'] }}" class="list-group-item list-group-item-action border-0 border-bottom h5 pb-0">
                                    {{ $GameMenu['ListTitle'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- 中央グリッド --}}
            <div class="col-4">
                <nav class="navbar">
                    <div class="container justify-content-center">
                        <a class="navbar-brand" href="{{ route('Home.home') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                                <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
                            </svg>   C-SYSTEM
                        </a>
                    </div>
                </nav>
            </div>
            {{-- 右グリッド --}}
            <div class="col-4">
                {{-- アカウントメニュー --}}
                <div class="text-end">
                    @auth
                        <div class="btn-group">
                            <button id="Hover" class="btn border-0 my-1 me-1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/avatar/' . Auth::user()->image) }}" class="rounded-circle border" width="35px" alt="">
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('Profile.account') }}">Cアカウント</a></li>
                                <li>
                                    <a class="dropdown-item">
                                        <form action="{{ route('Auth.logout') }}" method="POST">
                                            @csrf
                                            <button class="btn border-0 p-0" type="submit">ログアウト</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth

                    @guest
                        <div class="btn-group">
                            <button class="btn my-1 me-1" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('Auth.login') }}">ログイン</a></li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
</header>
{{-- Main --}}
<main>
@yield('content')
</main>
{{-- Footer --}}
<footer>

</footer>

{{-- Vite --}}
@vite('resources/js/app.js')
{{-- Cropper --}}
<script src="{{ asset('Layouts/JS/cropper.min.js') }}"></script>
@yield('jQuery')
</body>
</html>