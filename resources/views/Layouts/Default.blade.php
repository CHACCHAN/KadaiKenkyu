<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    {{-- Vite --}}
    @vite('resources/sass/app.scss')
    {{-- Cropper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.css">
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
                        <h5 class="offcanvas-title" id="SideMenuCanvasLabel">Backdrop with scrolling</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p>Try scrolling the rest of the page to see this option in action.</p>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
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
                                <li><a class="dropdown-item" href="#">設定</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>
@yield('jQuery')
</body>
</html>