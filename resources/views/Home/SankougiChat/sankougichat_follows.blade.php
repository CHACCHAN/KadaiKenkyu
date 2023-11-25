@extends('Home.SankougiChat.sankougichat')
@section('view')
<div class="col-9 p-0 border-end">
    {{-- 上部メニューバー --}}
    <div class="border-bottom ps-2 p-1">
        <div class="row">
            <div class="col-2">
                <a href="{{ route('Home.sankougichat.profile', $name_id) }}" class="btn border-0 text-start text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    {{-- 選択コンテンツ --}}
    <div class="border-bottom text-center">
        <div class="row">
            <div id="FollowLinkButton" class="col-6 btn border-0 fs-5 border-end rounded-0" @if(Request::is('sankougichat/follow/id=' . $name_id . '/Follow')) style="background: rgb(228, 228, 228);" @endif>
                フォロー
            </div>
            <div id="FollowerLinkButton" class="col-6 btn border-0 fs-5 rounded-0" @if(Request::is('sankougichat/follow/id=' . $name_id . '/Follower')) style="background: rgb(228, 228, 228); width: 49%;" @endif>
                フォロワー
            </div>
        </div>
    </div>
    {{-- フォロー一覧 --}}
    @if(Request::is('sankougichat/follow/id=' . $name_id . '/Follow'))
        @foreach($sankougi_chat_follows as $sankougi_chat_follow)
            <div class="row border-bottom mx-0">
                @foreach($sankougi_chat_users as $sankougi_chat_user)
                    @if($sankougi_chat_follow->chat_user_name_id == $sankougi_chat_user->name_id)
                        <div class="col-12">
                            <div class="d-flex mx-2 mt-2">
                                <a href="{{ route('Home.sankougichat.profile', $sankougi_chat_user->name_id) }}">
                                    @if($sankougi_chat_user->image_avatar)
                                        <img src="{{ asset('storage/sankougichat_user/avatar/' . $sankougi_chat_user->image_avatar) }}" class="rounded-circle border" width="40px">
                                    @else
                                        <img id="image_avatar" src="{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg') }}" class="rounded-circle border" width="40px">
                                    @endif
                                </a>
                                <div class="h5 ms-2 mt-2">{{ $sankougi_chat_user->name }}</div>
                                <div class="text-secondary ms-2 mt-2">{{ '@' . $sankougi_chat_user->name_id }}</div>
                            </div>
                            <div class="mx-2">
                                <div class="ms-5 mt-1">{!! nl2br(htmlspecialchars($sankougi_chat_user->content)) !!}</div>
                            </div>
                        </div>
                        @break
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
    {{-- フォロワー一覧 --}}
    @if(Request::is('sankougichat/follow/id=' . $name_id . '/Follower'))
        @foreach($sankougi_chat_followers as $sankougi_chat_follower)
            @if($sankougi_chat_follower->chat_user_name_id == $name_id)
                <div class="row border-bottom mx-0">
                    @foreach($sankougi_chat_users as $sankougi_chat_user)
                        @if($sankougi_chat_follower->chat_user_id == $sankougi_chat_user->chat_user_id)
                            <div class="col-12">
                                <div class="d-flex mx-2 mt-2">
                                    <a href="{{ route('Home.sankougichat.profile', $sankougi_chat_user->name_id) }}">
                                        @if($sankougi_chat_user->image_avatar)
                                            <img src="{{ asset('storage/sankougichat_user/avatar/' . $sankougi_chat_user->image_avatar) }}" class="rounded-circle border" width="40px">
                                        @else
                                            <img id="image_avatar" src="{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg') }}" class="rounded-circle border" width="40px">
                                        @endif
                                    </a>
                                    <div class="h5 ms-2 mt-2">{{ $sankougi_chat_user->name }}</div>
                                    <div class="text-secondary ms-2 mt-2">{{ '@' . $sankougi_chat_user->name_id }}</div>
                                </div>
                                <div class="mx-2">
                                    <div class="ms-5 mt-1">{!! nl2br(htmlspecialchars($sankougi_chat_user->content)) !!}</div>
                                </div>
                            </div>
                            @break
                        @endif
                    @endforeach
                </div>
            @endif    
        @endforeach
    @endif
</div>
<div class="col-3">

</div>
@endsection
@section('jQuery')
<script type="module">
    $('#FollowLinkButton').on('click', function() {
        window.location.href = '{{ route('Home.sankougichat.follow', ['name_id' => $name_id, 'type' => 'Follow']) }}';
    });
    $('#FollowerLinkButton').on('click', function() {
        window.location.href = '{{ route('Home.sankougichat.follow', ['name_id' => $name_id, 'type' => 'Follower']) }}';
    });
</script>
@endsection