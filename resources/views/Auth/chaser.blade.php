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
            <div class="mb-3">
                <label for="RegisterPasswordFormControlInput1" class="form-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-braces" viewBox="0 0 16 16">
                        <path d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z"/>
                    </svg>&nbsp;CHaserOnlineID
                </label>
                <input type="text" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="{{ Auth::user()->chaser_id }}" name="chaser_id">
            </div>
            <div class="mb-3">
                <label for="RegisterPasswordFormControlInput1" class="form-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-braces" viewBox="0 0 16 16">
                        <path d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z"/>
                    </svg>&nbsp;CHaserOnlinePassword
                </label>
                <input type="text" class="form-control" id="RegisterPasswordFormControlInput1" placeholder="{{ Auth::user()->chaser_password }}" name="chaser_password">
            </div>
            <button type="submit" class="btn btn-primary text-center">送信</button>
        </form>
    </div>
</div>
@endsection