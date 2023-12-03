@extends('Home.SankougiChat.sankougichat')
@section('view')
<div class="row">
    {{-- リスト --}}
    <div class="col-3 border-end">
        <div class="row">
            {{-- 検索バー --}}
            <div class="col-12 border-bottom">
                <div class="input-group ms-1 my-2">
                    <span class="input-group-text" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                    <input type="text" id="SearchInput" class="form-control" placeholder="検索" aria-describedby="basic-addon1">
                </div>
            </div>
            {{-- 友達一覧 --}}
            <div class="col-12 p-0">
                @foreach($sankougi_chat_follows as $sankougi_chat_follow)
                    <div class="row border-bottom mx-0 py-2">
                        @foreach($sankougi_chat_users as $sankougi_chat_user)
                            @if($sankougi_chat_follow->chat_user_name_id == $sankougi_chat_user->name_id)
                                <div class="col-12">
                                    <div class="d-flex mx-2">
                                        @if($sankougi_chat_user->image_avatar)
                                            <img src="{{ asset('storage/sankougichat_user/avatar/' . $sankougi_chat_user->image_avatar) }}" class="rounded-circle border" width="40px">
                                        @else
                                            <img id="image_avatar" src="{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg') }}" class="rounded-circle border" width="40px">
                                        @endif
                                        <div class="h5 ms-2 mt-2">{{ $sankougi_chat_user->name }}</div>
                                    </div>
                                </div>
                                @break
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- チャット画面 --}}
    <div class="col-9">
        
    </div>
</div>
@endsection