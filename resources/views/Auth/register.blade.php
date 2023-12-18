@extends('Layouts.Account')
@section('title', '新規登録')
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
                    新規登録
                </div>
                {{-- ユーザ情報 --}}
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-3 bg-secondary rounded-start py-2">
                                <div class="d-flex text-light py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>&nbsp;ユーザ情報<div class="text-danger">※必須</div>
                                </div>
                            </div>
                            <div class="col-9 py-2">
                                <div class="row me-2">
                                    {{-- 苗字 --}}
                                    <div class="col p-0">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text border-0" id="first_name">苗字</span>
                                            <input type="text" id="InputFirstName" class="form-control rounded" placeholder="三郷" aria-label="三郷" aria-describedby="first_name" name="first_name" required>
                                        </div>
                                    </div>
                                    {{-- 名前 --}}
                                    <div class="col p-0">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text border-0" id="last_name">名前</span>
                                            <input type="text" id="InputLastName" class="form-control rounded" placeholder="太郎" aria-label="太郎" aria-describedby="last_name" name="last_name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ニックネーム --}}
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-3 bg-secondary rounded-start py-2">
                                <div class="d-flex text-light py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
                                    </svg>&nbsp;ニックネーム
                                </div>
                            </div>
                            <div class="col-9 py-2">
                                <input type="text" id="InputNickName" class="form-control" placeholder="三郷工業技術高等学校" name="name">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 個人情報 --}}
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-3 bg-secondary rounded-start py-2">
                                <div class="d-flex text-light py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                                    </svg>&nbsp;個人情報<div class="text-danger">※必須</div>
                                </div>
                            </div>
                            <div class="col-9 py-2">
                                {{-- メールアドレス --}}
                                <label for="InputMailAddress" class="form-label m-0">メールアドレス</label>
                                <input type="email" id="InputMailAddress" class="form-control mb-3" placeholder="name@example.com" name="email" required>
                                @if(session('message'))
                                    <div id="EmailInput" class="form-text text-danger" id="basic-addon4">{{ session('message') }}</div>
                                @endif
                                {{-- パスワード --}}
                                <label for="InputPassword" class="form-label m-0">パスワード</label>
                                <input type="password" id="InputPassword" class="form-control mb-3" placeholder="Abcd1234" name="password" required>
                                {{-- 学科番号 --}}
                                <label for="InputClass" class="form-label m-0">学科番号</label>
                                <input type="text" id="InputClass" class="form-control" placeholder="C21G000" name="class_id" required>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 外部情報 --}}
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-3 bg-secondary rounded-start py-2">
                                <div class="d-flex text-light py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                    </svg>&nbsp;外部情報
                                </div>
                            </div>
                            <div class="col-9 py-2">
                                {{-- CHaserOnlineID --}}
                                <label for="InputCHaserOnlineID" class="form-label">CHaserOnlineID</label>
                                <input type="text" class="form-control mb-3" id="InputCHaserOnlineID" placeholder="20230416C300" name="chaser_id">
                                {{-- CHaserOnlinePassword --}}
                                <label for="InputCHaserOnlinePassword" class="form-label">CHaserOnlinePassword</label>
                                <input type="password" class="form-control" id="InputCHaserOnlinePassword" placeholder="Abcd1234" name="chaser_password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" id="SendButton" class="btn btn-primary">新規登録</button>
                    <button type="submit" id="EventButton" class="d-none"></button>
                </div>
        </form>
        <p class="text-end mt-3">既にアカウントをお持ちの方は<a href="{{ route('Auth.login') }}">こちら</a>から</p>
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
$('#RegisterMailFormControlInput1').on('input', function() {
    var inputValue = $(this).val();
    if (inputValue.length > 0) {
        $('#EmailInput').hide();
    }
});
</script>
<script type="text/javascript">
    var FirstName = "";
    var LastName = "";
    document.getElementById('InputFirstName').addEventListener('change', (e) => {
        FirstName = e.target.value;
        ChangeNickName(FirstName + " " + LastName);
    });

    document.getElementById('InputLastName').addEventListener('change', (e) => {
        LastName = e.target.value;
        ChangeNickName(FirstName + " " + LastName);
    });

    function ChangeNickName(e) {
        if(FirstName && LastName) {
            document.getElementById('InputNickName').value = e;
        }
    }
</script>
@endsection