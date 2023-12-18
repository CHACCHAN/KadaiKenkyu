@extends('Layouts.Account')
@section('title', '確認')
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
                パスワードの確認
            </div>
            {{-- 既存のパスワード --}}
            <div class="card mb-3">
                <div class="card-header p-1 pb-0 bg-light border-0">
                    現在のパスワードを入力してください
                </div>
                <div class="card-body p-1 pt-0">
                    @if(session('message'))
                        <div id="ErrLog" class="text-danger">{{ session('message') }}</div>
                    @endif
                    <input type="password" class="form-control border-0" placeholder="パスワードを入力" name="password" required>
                </div>
            </div>
            <button type="button" id="SendButton" class="btn btn-primary text-center">送信</button>
            <button type="submit" id="EventButton" class="d-none"></button>
        </form>
    </div>
</div>
@endsection
@section('jQuery')
<script type="text/javascript">
setTimeout(() => {
    document.getElementById('ErrLog').style.display = 'none';
}, 3000);
</script>
@endsection