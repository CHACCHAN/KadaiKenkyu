@extends('Layouts.Account')
@section('title', '新規登録')
@section('CSS')
<style>
#AccountForm {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

#Design {
    box-shadow: 0 0 20px rgb(98, 0, 255);
}
</style>
@endsection
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
                {{-- ユーザーネーム --}}
                <div class="mb-3">
                    <label for="RegisterNameFormControlInput1" class="form-label">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>&nbsp;ユーザーネーム<div class="text-danger">※必須</div>
                        </div>
                    </label>
                    <input type="text" class="form-control" id="RegisterNameFormControlInput1" placeholder="TPSくん" name="name" required>
                </div>
                {{-- メールアドレス --}}
                <div class="mb-3">
                    <label for="RegisterMailFormControlInput1" class="form-label">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>&nbsp;メールアドレス<div class="text-danger">※必須</div>
                        </div>           
                    </label>
                    <input type="email" class="form-control" id="RegisterMailFormControlInput1" placeholder="name@example.com" name="email" required>
                    @if(session('message'))
                        <div id="EmailInput" class="form-text text-danger" id="basic-addon4">{{ session('message') }}</div>
                    @endif
                </div>
                {{-- クラスID --}}
                <div class="mb-3">
                    <label for="RegisterPasswordFormControlInput1" class="form-label">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                            </svg>&nbsp;学科番号<div class="text-danger">※必須</div>
                        </div>
                    </label>
                    <input type="text" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="C21G000" name="class_id" required>
                </div>
                {{-- パスワード --}}
                <div class="mb-3">
                    <label for="RegisterPasswordFormControlInput1" class="form-label">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>&nbsp;パスワード<div class="text-danger">※必須</div>
                        </div>
                    </label>
                    <input type="password" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="Abcd1234" name="password" required>
                </div>
                <hr>
                {{-- CHaserOnlineID --}}
                <div class="mb-3">
                    <label for="RegisterPasswordFormControlInput1" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-braces" viewBox="0 0 16 16">
                            <path d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z"/>
                        </svg>&nbsp;CHaserOnlineID
                    </label>
                    <input type="text" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="20230416C300" name="chaser_id">
                </div>
                {{-- CHaserOnlinePassword --}}
                <div class="mb-3">
                    <label for="RegisterPasswordFormControlInput1" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-braces" viewBox="0 0 16 16">
                            <path d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z"/>
                        </svg>&nbsp;CHaserOnlinePassword
                    </label>
                    <input type="text" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="CH4ser@@" name="chaser_password">
                </div>
                <button type="submit" class="btn btn-primary text-center">新規登録</button>
        </form>
        <p class="text-end">既にアカウントをお持ちの方は<a href="{{ route('Auth.login') }}">こちら</a>から</p>
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
@endsection