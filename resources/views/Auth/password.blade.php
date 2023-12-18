@extends('Layouts.Account')
@section('title', 'パスワード変更')
@section('content')
<div id="AccountForm">
    <div id="Design" class="card overflow-auto p-3 w-50 h-50">
        <form action="{{ route('Auth.password.change') }}" method="POST">
            @csrf
            <div class="text-center">
                <img src="{{ asset('Layouts/Images/IconText.jpg') }}" width="200px" alt="">
            </div>
            <hr>
            <div class="card-text text-end">
                パスワードの変更
            </div>
            {{-- 既存のパスワード --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    既存のパスワード
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" class="form-control border-0" value="{{ $password }}" disabled>
                </div>
            </div>
            {{-- 新しいパスワード --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    新しいパスワード
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="password" class="form-control border-0" placeholder="新しいパスワードを入力" name="password" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection