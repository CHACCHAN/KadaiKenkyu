@extends('Layouts.Account')
@section('title', 'CHaserOnline更新')
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
                CHaserOnlineの更新
            </div>
            {{-- 既存のCHaserOnlineID --}}
            @if(Auth::user()->chaser_id)
                <div class="card mb-3">
                    <div class="card-header p-1 pb-0 bg-light border-0">
                        既存のCHaserOnlineID
                    </div>
                    <div class="card-body p-1 pt-0">
                        <input type="text" class="form-control border-0" value="{{ Auth::user()->chaser_id }}" disabled>
                    </div>
                </div>
            @endif
            {{-- 新しいCHaserOnlineID --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    新しいCHaserOnlineID
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" class="form-control border-0" name="chaser_id" required>
                </div>
            </div>
            @if(Auth::user()->chaser_password)
                {{-- 既存のCHaserOnlinePassword --}}
                <div class="card mb-3">
                    <div class="card-header p-1 pb-0 bg-light border-0">
                        既存のCHaserOnlinePassword
                    </div>
                    <div class="card-body p-1 pt-0">
                        <input type="text" class="form-control border-0" value="{{ Auth::user()->chaser_password }}" disabled>
                    </div>
                </div>
            @endif
            {{-- 新しいCHaserOnlinePassword --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    新しいCHaserOnlinePassword
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" class="form-control border-0" name="chaser_password" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection