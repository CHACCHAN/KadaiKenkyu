@extends('Layouts.default')
@section('title', '入退室フォーム')
@section('CSS')
<style>
    @keyframes Animation {
    0%, 100% {
        transform: rotate(10deg);
    }
    50% {
        transform: rotate(-10deg);
    }
}
    html,body {
        overflow: hidden
    }
    #PositionBack {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }
    #LoginButton:hover {
        filter: drop-shadow(0px 0px 10px black);
        animation: Animation 1s linear infinite;
    }
</style>
@endsection
@section('content')
<div class="row">
    @auth
        <div class="col-12 bg-dark">
            <div class="text-center text-light pt-2 h1">
                にゃーにゃー🐈入退室フォーム
            </div>
        </div>
    @endauth
    @guest
        <div class="col-12 p-0">
            <div id="TopWindow" class="position-relative">
                <img src="{{ asset('Home/JoinOut/Images/background_cat.gif') }}" alt="" width="100%" style="height: 100vh;">
                <div id="PositionBack" class="position-absolute">
                    <div class="card">
                        <div class="card-header text-center bg-light h5">
                            にゃーにゃー🐈入退室フォーム
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                クリックでログイン
                            </div>
                            <a href="{{ route('Auth.login') }}" class="btn border-0">
                                <img src="{{ asset('Home/JoinOut/Images/Nikukyu_button.png') }}" id="LoginButton" class="mx-auto" alt="" width="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</div>
@endsection