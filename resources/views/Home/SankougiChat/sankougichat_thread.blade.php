@extends('Home.SankougiChat.sankougichat')
@section('view')
<div class="row">
    <div class="col-12 p-0">
        @auth
            {{-- 上部メニューバー --}}
            <div class="border-bottom ps-2 p-1">
                <div class="row">
                    <div class="col-2">
                        {{-- 追加ボタン --}}
                        <button id="addButton" class="btn text-start border-0 text-primary" data-bs-toggle="modal" data-bs-target="#addMakeModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </button>
                        {{-- 追加モーダル --}}
                        <div class="modal fade" id="addMakeModal" tabindex="-1" aria-labelledby="addMakeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="modal-content">
                                            <div class="modal-header p-1 border-0">
                                                <div class="text-start pt-2">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="ThreadTitle" class="form-label">スレッドタイトルを入力してください</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="ThreadTitle" aria-describedby="basic-addon3 basic-addon4" name="title" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ThreadContent" class="form-label">スレッド説明を入力してください</label>
                                                    <div class="input-group">
                                                        <textarea type="text" class="form-control" rows="10" cols="80" id="ThreadContent" aria-describedby="basic-addon3 basic-addon4" name="content" style="resize: none;" required></textarea>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3">
                                                    <label for="ThreadImage" class="form-label">ヘッダー画像を設定する(任意)</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="ThreadImage" aria-describedby="basic-addon3 basic-addon4" name="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-primary">スレッドを作成</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 mx-2">
                {{-- 参加済みのスレッド --}}
                <div class="col-12">
                    <div class="h5 text-secondary">参加済みのスレッド {{ $sankougi_chat_thread_join_count }}/8</div>
                    @if(!$sankougi_chat_thread_joins->where('chat_user_id', '=', $sankougi_chat_user->chat_user_id)->first())
                        なし
                    @endif
                </div>
                @foreach($sankougi_chat_threads as $sankougi_chat_thread)
                    @foreach($sankougi_chat_thread_joins as $sankougi_chat_thread_join)
                        @if($sankougi_chat_thread_join->chat_user_id == $sankougi_chat_user->chat_user_id && $sankougi_chat_thread->id == $sankougi_chat_thread_join->sankougi_chat_thread_id)
                            <div class="col-6 col-md-3 mb-2">                       
                                <div class="card text-start">
                                    <div class="card-header p-0 bg-light">
                                        <div class="ms-1 my-0">
                                            <div class="dropdown">
                                                <button class="btn border-0 p-0 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                                    </svg>   {{ $sankougi_chat_thread->title }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if($sankougi_chat_thread->chat_user_id == $sankougi_chat_user->chat_user_id)
                                                        {{-- 管理者が退出する場合 --}}
                                                        <li><div class="btn border-0" data-bs-toggle="modal" data-bs-target="#deleteCheckModal">退出する</div></li>
                                                    @else
                                                        {{-- その他 --}}
                                                        <li><a class="dropdown-item" href="{{ route('Home.sankougichat.thread.delete', [
                                                            'name_id' => $sankougi_chat_user->name_id,
                                                            'sankougi_chat_thread_id' => $sankougi_chat_thread->id,
                                                        ]) }}">退出する</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            {{-- 削除確認モーダル 管理者のみ --}}
                                            <div class="modal fade" id="deleteCheckModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="modal-title h4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>   退出しますか?
                                                            </div>
                                                            <div class="modal-text mt-2">
                                                                あなたは、管理者権限を所有しています。
                                                            </div>
                                                            <div class="modal-text">
                                                                管理者が退出するとスレッド内のすべてのデータが削除されます。
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer p-1 border-0">
                                                            <a class="btn btn-danger" href="{{ route('Home.sankougichat.thread.delete', [
                                                            'name_id' => $sankougi_chat_user->name_id,
                                                            'sankougi_chat_thread_id' => $sankougi_chat_thread->id,
                                                            ]) }}">はい</a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        @if($sankougi_chat_thread->image)
                                            <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">
                                        @endif
                                        @if($sankougi_chat_thread->chat_user_id == $sankougi_chat_user->chat_user_id)
                                            <div class="row">
                                                <div class="col"></div>
                                                <div class="col"></div>
                                                <div class="col m-1">
                                                    <div class="text-end text-center border border-dark bg-warning rounded-pill">
                                                        管 理 者
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="ms-1">
                                            {!! nl2br(e($sankougi_chat_thread->content)) !!}
                                        </div>
                                        <div class="ms-1 text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            </svg> 参加者 : {{ $sankougi_chat_thread->join_count . '人' }}
                                        </div>     
                                    </div>
                                    <div class="card-footer p-1 border-0 bg-light">
                                        <div class="text-end">
                                            <a href="{{ route('Home.sankougichat.thread.category', [
                                                'name_id' => $sankougi_chat_user->name_id,
                                                'sankougi_chat_thread_id' => $sankougi_chat_thread->id,
                                            ]) }}" class="btn btn-primary p-1">入室する</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                {{-- スレッド一覧 --}}
                <div class="col-12 pt-2 border-top">
                    <div class="h5 text-secondary">スレッド一覧</div>
                </div>
                @foreach($sankougi_chat_threads as $sankougi_chat_thread)
                    <div class="col-6 col-md-3 mb-2">
                        {{-- カード --}}
                        <div class="card text-start">
                            <div class="card-header p-0 bg-light">
                                <div class="ms-1 my-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                    </svg>   {{ $sankougi_chat_thread->title }}
                                </div>
                            </div>
                            <button class="btn border-0 p-0 w-100">
                                <div class="card-body p-0 text-start" data-bs-toggle="modal" data-bs-target="#CardModal-{{ $sankougi_chat_thread->id }}">
                                    <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">
                                    <div class="ms-1">
                                        {!! nl2br(e($sankougi_chat_thread->content)) !!}
                                    </div>
                                    <div class="ms-1 text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                        </svg> 参加者 : {{ $sankougi_chat_thread->join_count . '人' ?? '0人' }}
                                    </div>
                                </div>
                            </button>
                            <div class="card-footer p-1 border-0 bg-light">
                                <div class="text-end">
                                    @php $i = 0; @endphp
                                    @foreach($sankougi_chat_thread_joins as $sankougi_chat_thread_join)
                                        @if($sankougi_chat_thread->id == $sankougi_chat_thread_join->sankougi_chat_thread_id && $sankougi_chat_thread_join->chat_user_id == $sankougi_chat_user->chat_user_id && $i == 0)
                                            <a href="" class="btn btn-primary p-1 disabled">参加済み</a>
                                            @php $i = 1; @endphp
                                            @break
                                        @endif
                                    @endforeach
                                    @if($i == 0)
                                        <a href="{{ route('Home.sankougichat.thread.join', [
                                            'name_id' => $sankougi_chat_user->name_id,
                                            'sankougi_chat_thread_id' => $sankougi_chat_thread->id,
                                        ]) }}" class="btn btn-success p-1">参加する</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- カードモーダル --}}                   
                        <div class="modal fade" id="CardModal-{{ $sankougi_chat_thread->id }}" tabindex="-1" aria-labelledby="CardModalLabel-{{ $sankougi_chat_thread->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-1">
                                        <h1 class="modal-title fs-4" id="CardModalLabel-{{ $sankougi_chat_thread->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                            </svg>   {{ $sankougi_chat_thread->title }}
                                        </h1>
                                    </div>
                                    <div class="modal-body p-0">
                                        @if($sankougi_chat_thread->image)
                                            <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">
                                        @endif
                                        <div class="m-3">
                                            <div class="h5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                </svg>   スレッド説明:
                                            </div>
                                            {!! nl2br(e($sankougi_chat_thread->content)) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <div class="text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            </svg> 参加者 : {{ $sankougi_chat_thread->join_count . '人' ?? '0人'}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
    // スレッドが8以上参加している場合無効化する
    $(document).ready(function() {
        var SetCount = {{ $sankougi_chat_thread_join_count }};
        if(SetCount >= 8) {
            $('#addButton').addClass("disabled");
        }
    });
</script>
@endsection