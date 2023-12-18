@extends('Layouts.Account')
@section('title', '学科番号更新')
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
                学科番号の変更
            </div>
            {{-- 既存の学科番号 --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    既存の学科番号
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" class="form-control border-0" value="{{ Auth::user()->class_id }}" disabled>
                </div>
            </div>
            {{-- 新しい学科番号 --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    新しい学科番号
                </div>
                <div class="card-body p-1 pt-0">
                    <input type="text" class="form-control border-0" value="{{ Auth::user()->class_id }}" name="class_id" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection