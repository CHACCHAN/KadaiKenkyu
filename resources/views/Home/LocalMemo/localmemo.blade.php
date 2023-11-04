@extends('Layouts.Default')
@section('title', 'ローカルメモ')
@section('CSS')
    <link rel="stylesheet" href="{{ asset('Home/LocalMemo/CSS/style.css') }}">
@endsection
@php
    $Count = 0;
@endphp
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- 作成ボタン --}}
        <div class="col-12">
            <div class="mt-2 mb-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateModal">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                            <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                        </svg><div class="ms-1 fs-6">新規作成</div>
                    </div>
                </button>
            </div>
        </div>
        {{-- 作成モーダル --}}
        <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                                <div class="card-title">
                                    <div class="mb-3">
                                        <input type="text" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="タイトルを入力" name="title">
                                    </div>
                                </div>
                                <div class="card-text">
                                    <div class="mb-3">
                                        <textarea type="text" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="内容を入力" rows=15 style="resize: none;" name="content"></textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary w-100">保存</button>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        {{-- メモを一覧 --}}
        <p class="ms-3 text-secondary">メモを一覧</p>
        {{-- カード --}}
        @foreach($localmemos as $localmemo)
        @php $Count = $Count + 1; @endphp
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card mb-3">
                    @if($localmemo->image)
                        <div class="card-header p-0" data-bs-toggle="modal" data-bs-target="#Count-@php echo $Count @endphp">
                            <img src="{{ asset('storage/localmemo/'. $localmemo->image) }}" alt="" width="100%">
                        </div>
                    @endif
                    <div class="card-body" data-bs-toggle="modal" data-bs-target="#Count-@php echo $Count @endphp">
                        <div id="Card-Title-@php echo $Count; @endphp" class="card-title">
                            {!! nl2br(htmlspecialchars($localmemo->title)) !!}
                        </div>
                        <div id="Card-Content-@php echo $Count; @endphp" class="card-text">
                            {!! nl2br(htmlspecialchars($localmemo->content)) !!}
                        </div>
                    </div>
                    <div id="Card-Header" class="card-header bg-light">
                        <div class="row">
                            <div class="col-12 text-end">
                                {{-- 画像 --}}
                                <button class="btn border-0 p-0 m-0" data-bs-toggle="modal" data-bs-target="#Count-@php echo $Count @endphp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                    </svg>
                                </button>
                                {{-- 編集 --}}
                                <button class="btn border-0 p-0 m-0 ms-3" data-bs-toggle="modal" data-bs-target="#Count-@php echo $Count @endphp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </button>
                                {{-- 削除 --}}
                                <button class="btn border-0 p-0 m-0 ms-3" data-bs-toggle="modal" data-bs-target="#Delete-@php echo $Count @endphp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- 削除モーダル --}}
                    <div class="modal fade" id="Delete-@php echo $Count @endphp" tabindex="-1" aria-labelledby="Count-@php echo $Count @endphp-Label" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-start">
                                    {{ $localmemo->title }}を削除しますか？
                                </div>
                                <div class="modal-footer p-0 py-1">
                                    <a class="btn btn-danger" href="{{ route('Home.localmemo.delete', $localmemo->id) }}">はい</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- カードモーダル --}}
                <div class="modal fade" id="Count-@php echo $Count @endphp" tabindex="-1" aria-labelledby="Count-@php echo $Count @endphp-Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            @if($localmemo->image)
                                <div class="modal-header p-0">
                                    {{-- 画像 --}}
                                    <img src="{{ asset('storage/localmemo/'. $localmemo->image) }}" class="position-relative" alt="" width="100%">
                                    {{-- 画像削除ボタン --}}
                                    <div id="imageDelete" class="dropdown">
                                        <div id="imageDelete" class="position-absolute text-light text-center btn btn-danger p-0 px-1 pb-1" style="top: -100px;right: 10px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('Home.localmemo.delete.image', $localmemo->id) }}">画像を削除</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="modal-body">
                                <div class="card-title">
                                    <div class="mb-3">
                                        <textarea type="text" id="Title-Input-@php echo $Count @endphp" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="タイトルを入力" rows=1 style="resize: none;" name="title" required>{{$localmemo->title }}</textarea>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <div class="mb-3">
                                        <textarea type="text" id="Content-Input-@php echo $Count @endphp" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="内容を入力" rows=15 style="resize: none;" name="content" required>{{ $localmemo->content }}</textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="row">
                                        {{-- 画像を差し込み --}}
                                        <div class="col-9">
                                            <form id="Card-Image-@php echo $Count; @endphp" action="{{ route('Home.localmemo.update') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                    <textarea name="id" style="display:none;">{{ $localmemo->id }}</textarea>
                                                    <input type="file" class="form-control" name="image">
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <div class="text-center d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise mt-2" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                                </svg>
                                                <div class="fs-5 mt-1 ms-1">
                                                    自動更新
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <script type="module">
                                // 送信
                                document.querySelector("#Card-Image-@php echo $Count; @endphp input[type=file]").addEventListener("change", function() {
                                    document.querySelector("#Card-Image-@php echo $Count; @endphp").submit();
                                });

                                // 非同期通信
                                const csrfToken = document.querySelector("[name='csrf-token']").getAttribute("content");
                                const titleInput = document.querySelector('#Title-Input-@php echo $Count; @endphp');
                                const contentInput = document.querySelector('#Content-Input-@php echo $Count; @endphp');
                                const cardTitle = document.querySelector('#Card-Title-@php echo $Count; @endphp');
                                const cardContent = document.querySelector('#Card-Content-@php echo $Count; @endphp');

                                titleInput.addEventListener("input", function () {
                                    sendAjaxRequest();
                                });

                                contentInput.addEventListener("input", function () {
                                    sendAjaxRequest();
                                });

                                function sendAjaxRequest() {
                                    const id = {{ $localmemo->id }};
                                    const title = titleInput.value;
                                    const content = contentInput.value;

                                    fetch("{{ route('Home.localmemo.update') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": csrfToken,
                                        },
                                        body: JSON.stringify({
                                            id: id,
                                            title: title,
                                            content: content,
                                        }),
                                    })
                                    .then((response) => {
                                        if (!response.ok) {
                                            console.log(response);
                                            throw new Error('ネットワークエラーまたは不正なレスポンス');
                                        }
                                        return response.json();
                                    })
                                    .then((data) => {
                                        console.log(data);
                                        cardTitle.innerHTML = escapeHTML(data.title);
                                        cardContent.innerHTML = nl2br(escapeHTML(data.content));
                                    })
                                    .catch((error) => {
                                        console.error("エラーが発生しました", error);
                                    });
                                }

                                function escapeHTML(unsafeText) {
                                    return unsafeText
                                        .replace(/&/g, "&amp;")
                                        .replace(/</g, "&lt;")
                                        .replace(/>/g, "&gt;")
                                        .replace(/"/g, "&quot;")
                                        .replace(/'/g, "&#039");
                                }

                                function nl2br(str) {
                                    return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
    $(document).ready(function() {
        // カードをホバーしたときの処理
        $('.card').hover(function() {
            $(this).find('#Card-Header').css('display', 'block');
        }, function() {
            $(this).find('#Card-Header').css('display', 'none');
        });

        $('.modal-header').hover(function() {
            $(this).find('#imageDelete').css('display', 'block');
        }, function() {
            $(this).find('#imageDelete').css('display', 'none');
        });
    });
</script>
@endsection