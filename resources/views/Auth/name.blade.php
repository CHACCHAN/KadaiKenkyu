@extends('Layouts.Account')
@section('title', '名前更新')
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
                名前の更新
            </div>
            {{-- 苗字と名前の変更 --}}
            <div class="d-flex mb-3">
                <div class="card w-100 me-1">
                    <div class="card-header p-1 pb-0 bg-light border-0">
                        苗字の変更
                    </div>
                    <div class="card-body p-1 pt-0">
                        <input type="text" id="RegisterBeforeName" class="form-control border-0" name="first_name" value="{{ Auth::user()->first_name }}" required>
                    </div>
                </div>
                <div class="card w-100 ms-1">
                    <div class="card-header p-1 pb-0 bg-light border-0">
                        名前の変更
                    </div>
                    <div class="card-body p-1 pt-0">
                        <input type="text" id="RegisterBeforeName" class="form-control border-0" name="last_name" value="{{ Auth::user()->last_name }}" required>
                    </div>
                </div>
            </div>
            {{-- ニックネームの変更 --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    ニックネームの変更
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" id="RegisterBeforeName" class="form-control border-0" name="name" value="{{ Auth::user()->name }}" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection