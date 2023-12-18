@extends('Layouts.Account')
@section('title', 'メールアドレス更新')
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
                メールアドレスの変更
            </div>
            {{-- 既存のメールアドレス --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    既存のメールアドレス
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="email" class="form-control border-0" value="{{ Auth::user()->email }}" disabled>
                </div>
            </div>
            {{-- メールアドレス --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    新しいメールアドレス
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="email" class="form-control border-0" value="{{ Auth::user()->email }}" name="email" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection