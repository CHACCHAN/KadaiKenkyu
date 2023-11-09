@extends('Home.SankougiChat.sankougichat')
@section('CSS')
<style>
    #image_header:hover {
        opacity: 0.5;
        transition: 0.3s;
    }

    #image_avatar:hover {
        background: white;
        opacity: 0.8;
        transition: 0.3s;
    }
</style>
@endsection
@section('view')
<div class="row">
    <div class="col-9 p-0 border-end">
        <div class="position-relative p-0">
            <a href="#" data-bs-toggle="modal" data-bs-target="#HeaderBackdrop">
                <img id="image_header" src="{{ asset('storage/sankougichat_user/header/'. $sankougi_chat_user->image_header) }}" alt="" width="100%">
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#AvatarBackdrop">
                <img id="image_avatar" src="{{ asset('storage/sankougichat_user/avatar/'. $sankougi_chat_user->image_avatar) }}" class="position-absolute rounded-circle border" style="top: 60%; left: 5%;" width="20%" >
            </a>
        </div>
        <div class="ms-4">
            <div class="text-end">
                @if($sankougi_chat_user->user_id == Auth::id())
                    {{-- プロフィール編集ボタン --}}
                    <button class="btn btn-dark mt-2 me-2" data-bs-toggle="modal" data-bs-target="#editProfile">
                        プロフィールを編集する
                    </button>
                    {{-- プロフィール編集モーダル --}}
                    <div class="modal fade" id="editProfile" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                        <div class="h5 ms-2">
                                            プロフィールの編集
                                        </div>
                                    </div>
                                    <button type="button" id="profileUpdateSubmit" class="btn btn-dark">保存</button>
                                </div>
                                <div class="modal-body text-start">
                                    {{-- 名前 --}}
                                    <div class="mb-3">
                                        <label for="nameInput" class="form-label">名前</label>
                                        <input type="text" class="form-control form-control-lg" id="nameInput" value="{{ $sankougi_chat_user->name }}" maxlength=20 required>
                                    </div>
                                    {{-- 自己紹介 --}}
                                    <div class="mb-3">
                                        <label for="contentInput" class="form-label">自己紹介</label>
                                        <textarea class="form-control" id="contentInput" rows="15" style="resize: none;" maxlength=160 required>{{ $sankougi_chat_user->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ヘッダーモーダル　トリミング用 --}}
                    <div class="modal fade" id="HeaderBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                {{-- トリミング画像 --}}
                                <div class="card-header p-0">
                                    <div id="HeaderEdit" class="fs-6 text-secondary text-center">画像エディター</div>
                                    <img src="" id="HeaderImage" width="100%">
                                </div>
                                {{-- インプット --}}
                                <div class="modal-body">
                                    <input type="file" id="image_headerInput" class="form-control" name="image_header">
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" id="HeaderSubmit" class="btn btn-primary" style="display: none;" data-bs-dismiss="modal">保存</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- アバターモーダル　トリミング用 --}}
                    <div class="modal fade" id="AvatarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                {{-- トリミング画像 --}}
                                <div class="card-header p-0">
                                    <div id="AvatarEdit" class="fs-6 text-secondary text-center">画像エディター</div>
                                    <img src="" id="AvatarImage" width="100%">
                                </div>
                                {{-- インプット --}}
                                <div class="modal-body">
                                    <input type="file" id="image_avatarInput" class="form-control" name="image_avatar">
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" id="AvatarSubmit" class="btn btn-primary" style="display: none;" data-bs-dismiss="modal">保存</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br><br>
                @endif
            </div>
            {{-- プロフィール要素 --}}
            <div id="PreviewName" class="fs-3 mt-5">{{ $sankougi_chat_user->name }}</div>
            <div id="PreviewNameID" class="fs-5 text-secondary">{{ '@'. $sankougi_chat_user->name_id }}</div>
            <div id="PreviewContent" class="mt-2">{{ $sankougi_chat_user->content }}</div>
            <div class="text-secondary mt-3 pb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg>   {{ $sankougi_chat_user->created_at->format('Y年m月') }}から三工技チャットを利用しています
            </div>
        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
 
</script>
@endsection