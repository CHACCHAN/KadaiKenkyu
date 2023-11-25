@extends('Home.SankougiChat.sankougichat')
@section('view')
<div class="row">
    <div class="col-9 border-end">
        <div class="row">
            {{-- 検索コンテンツ --}}
            <div class="col-12 px-4">
                <div class="dropdown-center">
                    <div class="input-group my-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="SearchInput" class="form-control" placeholder="@でユーザ検索" aria-describedby="basic-addon1">
                    </div>
                    <ul class="dropdown-menu w-100">
                        <div id="ResultSearch"></div>
                    </ul>
                </div>
            </div>
            {{-- 人気の投稿 --}}
            <div class="col-12 px-4 mt-3 border-bottom">
                <div class="h5 text-secondary">人気の投稿 {{ $sankougi_chats->count() }}件</div>
                @foreach($sankougi_chats as $sankougi_chat)
                    @foreach($sankougi_chat_users as $sankougi_chat_user)    
                        @if($sankougi_chat->chat_user_id == $sankougi_chat_user->chat_user_id)
                            <div class="card mb-2">
                                <div class="card-header bg-light border-0">
                                    <div class="d-flex">
                                        {{-- アバター --}}
                                        @if($sankougi_chat_user->image_avatar)
                                            <a href="{{ route('Home.sankougichat.profile', $sankougi_chat_user->name_id) }}">
                                                <img src="{{ asset('storage/sankougichat_user/avatar/' . $sankougi_chat_user->image_avatar)}}" class="rounded-circle border" alt="" width="40px">
                                            </a>
                                        @else
                                            <a href="{{ route('Home.sankougichat.profile', $sankougi_chat_user->name_id) }}">
                                                <img src="{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg')}}" class="rounded-circle border" alt="" width="40px">
                                            </a>
                                        @endif
                                        {{-- 名前と日付 --}}
                                        <div class="d-flex ms-2 mt-2">
                                            <div class="h5">{{ $sankougi_chat_user->name }}</div>
                                            <div class="text-secondary ms-2">
                                                @php
                                                    $interval = \Carbon\Carbon::now()->diff($sankougi_chat->created_at);
                                                @endphp
                                                @if($interval->y != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->y . '年前' }}
                                                @elseif($interval->m != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->m . 'ヶ月前' }}
                                                @elseif($interval->d != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->d . '日前' }}
                                                @elseif($interval->h != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->h . '時間前' }}
                                                @elseif($interval->i != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->i . '分前' }}
                                                @elseif($interval->s != 0)
                                                    {{ '@' . $sankougi_chat_user->name_id . '・' . $interval->s . '秒前' }}
                                                @else
                                                    {{ '@' . $sankougi_chat_user->name_id . '・1秒前' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('Home.sankougi.pickup', [
                                    'name_id' => $sankougi_chat_user->name_id,
                                    'chat_id' => $sankougi_chat->chat_id,
                                ]) }}" class="text-dark text-decoration-none">
                                    <div class="card-body pt-0">
                                        {!! nl2br(htmlspecialchars($sankougi_chat->content)) !!}
                                        @if($sankougi_chat->image)
                                            <img src="{{ asset('storage/sankougichat/post/'. $sankougi_chat->image) }}" class="rounded" alt="" width="100%">
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @break
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-3">

    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
    $('#SearchInput').on('input', function() {
        var Command = this.value.slice(0, 1);
        var mode;
        var content;
        var image_avatar;

        // 置換
        $('#ResultSearch').html('');
        $('#ResultSearch').html(`
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);
        // nameID検索だったら
        if(Command === '@') {
            mode = 'nameID';
            content = this.value.slice(1);
        // 投稿コンテンツ検索
        } else {
            mode = 'search';
            content = this.value;
        }
        // Ajaxで検索
        setTimeout(function() {
            $('#ResultSearch').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('Home.sankougichat.search') }}",
                type: 'POST',
                data: {
                    mode: mode,
                    content: content,
                },
            })
            .done((res) => {
                console.log(res);
                if(Command === '@') {
                    res.sankougi_chat_users.forEach((sankougi_chat_user, index, array) => {
                        if(sankougi_chat_user.image_avatar) {
                            image_avatar = '{{ asset('storage/sankougichat_user/avatar') }}/' + sankougi_chat_user.image_avatar;
                        } else {
                            image_avatar = '{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg')}}';
                        }
                        $('#ResultSearch').append(`
                            <div class="mx-1">
                                <a href="{{ url('sankougichat/profile') }}/id=${sankougi_chat_user.name_id}" class="text-decoration-none text-dark">
                                    <div class="d-flex">
                                        <img src="${image_avatar}" class="rounded-circle border" alt="" width="40px">
                                        <div class="ms-2 mt-2 h5">${sankougi_chat_user.name}</div>
                                        <div class="ms-2 mt-2 text-secondary">@${sankougi_chat_user.name_id}</div>
                                    </div>
                                </a>
                            </div>
                        `);
                    });
                } else {
                    res.results.forEach((result, index, array) => {
                        res.sankougi_chat_users.forEach((sankougi_chat_user, index, array) => {
                            if(result.chat_user_id === sankougi_chat_user.chat_user_id) {
                                if(sankougi_chat_user.image_avatar) {
                                    image_avatar = '{{ asset('storage/sankougichat_user/avatar') }}/' + sankougi_chat_user.image_avatar;
                                } else {
                                    image_avatar = '{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg')}}';
                                }
                                $('#ResultSearch').append(`
                                    <div class="mx-1">
                                        <div class="d-flex">
                                            <a href="{{ url('sankougichat/profile') }}/id=${sankougi_chat_user.name_id}">
                                                <img src="${image_avatar}" class="rounded-circle border" alt="" width="40px">
                                            </a>
                                            <a href="{{ url('sankougichat/pickup') }}/id=${sankougi_chat_user.name_id}/post=${result.chat_id}" class="text-decoration-none text-dark">
                                                <div class="d-flex">
                                                    <div class="ms-2 mt-2 h5">${sankougi_chat_user.name}</div>
                                                    <div class="ms-2 mt-2">${result.content}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                `);
                            }
                        });
                    });
                }
            })
            .fail((error) => {
                console.log(error);
            });
        }, 500)
    });
</script>
@endsection