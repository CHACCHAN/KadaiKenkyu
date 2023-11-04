@extends('Layouts.Default')
@section('title', 'ローカルメモ')
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
        {{-- カード --}}
        @foreach($localmemos as $localmemo)
        @php $Count = $Count + 1; @endphp
            <div class="col-6 col-md-4 col-lg-2">
                <p class="ms-3 text-secondary">メモを一覧</p>
                <div class="card">
                    <div class="card-body" data-bs-toggle="modal" data-bs-target="#Count-@php echo $Count @endphp">
                        <div class="card-title">
                            {{ $localmemo->title }}
                        </div>
                        <div class="card-text">
                            {{ $localmemo->content }}
                        </div>
                    </div>
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-12 text-end">
                                <button class="btn border-0 p-0 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                    </svg>
                                </button>
                                <button class="btn border-0 p-0 m-0 ms-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </button>
                                {{-- 削除 --}}
                                <button class="btn border-0 p-0 m-0 ms-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </button>
                                {{-- 削除モーダル --}}
                                <div class="modal fade" id="Delete-@php echo $Count @endphp" tabindex="-1" aria-labelledby="Count-@php echo $Count @endphp-Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                        </div>
                                    </div>
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
                                    <img src="{{ asset('storage/localmemo/'.$localmemo->image) }}" alt="" width="100%">
                                </div>
                            @endif
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="modal-body">
                                        <div class="card-title">
                                            <div class="mb-3">
                                                <textarea type="text" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="タイトルを入力" rows=1 style="resize: none;" name="title" required>{{ $localmemo->title }}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-text">
                                            <div class="mb-3">
                                                <textarea type="text" class="form-control border-0 m-0 p-0 py-2 px-2" placeholder="内容を入力" rows=15 style="resize: none;" name="content" required>{{ $localmemo->content }}</textarea>
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
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('jQuery')
<script type="module" src="{{ asset('Home/LocalMemo/JS/app.js') }}"></script>
@endsection