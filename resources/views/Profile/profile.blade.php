@extends('Layouts.Default')
@section('title', 'プロフィール')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- メニュー --}}
        <div class="col-3">
            <div class="mt-3">
                <div class="list-group list-group-flush">
                    <a href="{{ route('Profile.account') }}" class="list-group-item list-group-item-action @if(Request::is('profile/account')) @php echo 'list-group-item-secondary' @endphp @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>&nbsp;&nbsp;Cアカウント
                    </a>
                    <a href="{{ route('Profile.secure') }}" class="list-group-item list-group-item-action @if(Request::is('profile/secure')) @php echo 'list-group-item-secondary' @endphp @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
                        </svg>&nbsp;&nbsp;セキュリティ
                    </a>
                    <a href="" class="list-group-item list-group-item-action @if(Request::is('profile/dashboard')) @php echo 'list-group-item-secondary' @endphp @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark-dash-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6z"/>
                        </svg>&nbsp;&nbsp;ダッシュボード
                    </a>
                    <a href="" class="list-group-item list-group-item-action @if(Request::is('profile/help')) @php echo 'list-group-item-secondary' @endphp @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                        </svg>&nbsp;&nbsp;ヘルプ
                    </a>
                </div>
            </div>
        </div>
        {{-- 編集画面 --}}
        <div class="col-9">
            <div class="mt-3">
                @yield('view')
            </div> 
        </div>
    </div>
</div>

@endsection