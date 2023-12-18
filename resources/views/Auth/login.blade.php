@extends('Layouts.Account')
@section('title', 'ログイン')
@section('content')
<div id="AccountForm">
    <div id="Design" class="card overflow-auto p-3 w-50 h-50">
        <form action="" method="POST">
            @csrf
            <div class="text-center">
                <img src="{{ asset('Layouts/Images/IconText.jpg') }}" width="200px" alt="">
            </div>
            <hr>
            <div class="card-text text-end">
                サイトへログインする
            </div>
            @if(session('message'))
                <div id="Error" class="card bg-dark">
                    <div class="card-body">
                        <div class="text-danger">{{ session('message') }}</div>
                    </div>
                </div>
            @endif
            {{-- メールアドレス --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    メールアドレス
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="email" class="form-control border-0" placeholder="name@example.com" name="email" required>
                </div>
            </div>
            {{-- パスワード --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    パスワード
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="password" class="form-control border-0" placeholder="Abcd1234" name="password" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">ログイン</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
        <p class="text-end">アカウント登録は<a href="{{ route('Auth.register') }}">こちら</a>から</p>
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
$(document).ready(function(){
    setTimeout(function() {
        $("#Error").fadeOut();
    }, 5000);
});
</script>
@endsection