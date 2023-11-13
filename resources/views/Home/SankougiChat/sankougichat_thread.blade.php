@extends('Home.SankougiChat.sankougichat')
@section('view')
<div class="row">
    <div class="col-12 p-0">
        {{-- 上部メニューバー --}}
        <div class="border-bottom ps-2 p-1">
            <div class="row">
                <div class="col-2">
                    {{-- 追加ボタン --}}
                    <button class="btn text-start border-0 text-primary" data-bs-toggle="modal" data-bs-target="#addMakeModal">
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
                <div class="h5 text-secondary">参加済みのスレッド</div>
                @if(!$sankougi_chat_thread_joins->where('chat_user_id', '=', $sankougi_chat_user->chat_user_id)->first())
                    なし
                @endif
            </div>
            @foreach($sankougi_chat_threads as $sankougi_chat_thread)
                @foreach($sankougi_chat_thread_joins as $sankougi_chat_thread_join)
                    @if($sankougi_chat_thread->id == $sankougi_chat_thread_join->sankougi_chat_thread_id && $sankougi_chat_thread_join->chat_user_id == $sankougi_chat_user->chat_user_id)
                        <div class="col-6 col-md-3 mb-2">
                            <button class="btn border-0 p-0 w-100">
                                <div class="card text-start">
                                    <div class="card-header p-0 bg-light">
                                        <div class="ms-1 my-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                            </svg>   {{ $sankougi_chat_thread->title }}
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">
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
                                            <div class="btn btn-primary p-1">入室する</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    @endif
                @endforeach
            @endforeach
            {{-- スレッド一覧 --}}
            <div class="col-12 pt-2 border-top">
                <div class="h5 text-secondary">スレッド一覧</div>

            </div>
            @foreach($sankougi_chat_threads as $sankougi_chat_thread)
                @foreach($sankougi_chat_thread_joins as $sankougi_chat_thread_join)
                    @if($sankougi_chat_thread->id == $sankougi_chat_thread_join->sankougi_chat_thread_id && $sankougi_chat_thread->chat_user_id == $sankougi_chat_thread_join->chat_user_id)
                        @break
                    @else
                        <div class="col-6 col-md-3 mb-2">
                            <button class="btn border-0 p-0 w-100">
                                <div class="card text-start">
                                    <div class="card-header p-0 bg-light">
                                        <div class="ms-1 my-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                            </svg>   {{ $sankougi_chat_thread->title }}
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">
                                        <div class="ms-1">
                                            {!! nl2br(e($sankougi_chat_thread->content)) !!}
                                        </div>
                                        <div class="ms-1 text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            </svg> 参加者 : {{ $sankougi_chat_thread->join_count ?? 0 . '人' }}
                                        </div>
                                        
                                    </div>
                                    <div class="card-footer p-1 border-0 bg-light">
                                        <div class="text-end">
                                            <div class="btn btn-success p-1">参加する</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        @break
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection