@extends('Layouts.Default')
@section('title', '三工技チャット新規作成')
@section('content')
<div class="container-fluid bg-dark" style="height: 94vh;">
    {{-- プロフィールを作成 --}}
    <div class="row pt-5">
        <div class="col-12">
            {{-- 作成カード --}}
            <div class="container">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="d-flex mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                            <div class="h4 ms-2">プロフィールを作成</div>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    {{-- 左側コンテンツ --}}
                                    <div class="col-5 pb-3">
                                        <p class="text-secondary m-0">プロフィールの編集</p>
                                        {{-- 名前 --}}
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header border-0 bg-light ms-1 mt-1 p-0">
                                                    名前
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="input-group input-group-lg">
                                                        <input type="text" id="nameInput" class="form-control border-0" name="name" maxlength=20 required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- 自己紹介 --}}
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header border-0 bg-light ms-1 mt-1 p-0">
                                                    自己紹介
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="input-group input-group-lg">
                                                        <textarea type="text" id="contentInput" class="form-control border-0" name="content" rows=8 style="resize: none;" maxlength=160 required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="text-secondary m-0">ヘッダーを登録(任意)</p>
                                        {{-- ヘッダー --}}
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#HeaderBackdrop">クリック</button>
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
                                        </div>
                                        <p class="text-secondary m-0">アバターを登録(任意)</p>
                                        {{-- アバター --}}
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#AvatarBackdrop">クリック</button>
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
                                        </div>
                                        <div class="text-end">
                                            <button type="button" id="formSubmit" class="btn btn-primary">保存</button>
                                        </div>
                                    </div>
                                    {{-- 右側コンテンツ --}}
                                    <div class="col-7 border-start pb-3">
                                        <p class="text-secondary m-0">プレビュー</p>
                                        {{-- プレビュー用カード --}}
                                        <div class="card w-100">
                                            <div class="card-header position-relative p-0">
                                                <img id="PreviewHeader" src="{{ asset('Home/SankougiChat/header/sample_header.jpeg') }}" alt="" width="100%">
                                                <img id="PreviewAvatar" src="{{ asset('Home/SankougiChat/avatar/sample_avatar.jpeg') }}" class="position-absolute rounded-circle border" style="top: 60%; left: 5%;" width="20%">
                                            </div>
                                            <div class="card-body">
                                                <div class="ms-4">
                                                    <div id="PreviewName" class="fs-3 mt-5 pt-3">埼玉県立三郷工業技術高等学校</div>
                                                    <div id="PreviewNameID" class="fs-5 text-secondary"></div>
                                                    <div id="PreviewContent" class="mt-2">
                                                        教育目標：健康で健全な技術者を育成する<br>
                                                        1 豊かな心を育み、人間尊重の精神を培う<br>
                                                        2 基礎基本となる知識・技術・技能を習得させ、創造性あふれる技術者を育成する<br>
                                                        3 体を鍛えるとともに、社会の一員としての自覚を高めさせる<br>
                                                        <br>
                                                        目指す学校像<br>
                                                        「ものづくりの精神」に基づき、豊かな人間性を育成するとともに、学力向上をとおして、生徒の自信を高め、地域に貢献できる技術者を育成する<br>
                                                        <br>
                                                        重点目標<br>
                                                        1 基礎学力や専門知識・技術の習得を重視し、学習指導を充実させる<br>
                                                        2 生徒指導及び進路指導の充実を図り、社会人基礎力を身につけさせる<br>
                                                        3 開かれた学校づくりに取り組み、工業高校の魅力を積極的に発信する<br>
                                                    </div>
                                                    <div class="text-secondary mt-3 pb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                        </svg>   {{ \Carbon\Carbon::now()->format('Y年m月') }}から三工技チャットを利用しています
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">

        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
    // グローバル変数
    var image_header;
    var image_avatar;
    var name_id;

    // 検索IDを取得して非同期で反映
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "{{ route('Home.sankougichat.profile.userid') }}",
            dataType: "json",
        })
        .done((res) => {
            $("#PreviewNameID").html('@' + res.name_id);
            name_id = res.name_id;
        })
        .fail((error) => {
            console.log(error.statusText);
        });
    });

    // ヘッダー画像の編集
    $('#image_headerInput').on('change', function(e) {
        // 保存ボタンを表示する
        $('#HeaderSubmit').show();
        $('#HeaderEdit').html('画像をトリミングする<hr>');
        // 1枚だけ表示する
        var file = e.target.files[0];
        // ファイルのブラウザ上でのURLを取得する
        var blobUrl = window.URL.createObjectURL(file);
        // img要素に表示
        $('#HeaderImage').attr('src', blobUrl);
        var target = document.getElementById('HeaderImage');
        var cropper = new Cropper(target,{aspectRatio: 16 / 5});
        // トリミングボタンを押したとき
        $('#HeaderSubmit').on('click', function() {
            // トリミングパネル内のcanvasを取得
            var canvas = cropper.getCroppedCanvas();
            // canvasをbase64に変換
            var data = canvas.toDataURL("image/png");
            var preview = document.getElementById('PreviewHeader');
            // previewにセットする
            preview.src = data;
            // グローバル変数に代入
            image_header = data;
        });
    });

    // アバター画像の編集
    $('#image_avatarInput').on('change', function(e) {
        // 保存ボタンを表示する
        $('#AvatarSubmit').show();
        $('#AvatarEdit').html('画像をトリミングする<hr>');
        // 1枚だけ表示する
        var file = e.target.files[0];
        // ファイルのブラウザ上でのURLを取得する
        var blobUrl = window.URL.createObjectURL(file);
        // img要素に表示
        $('#AvatarImage').attr('src', blobUrl);
        var target = document.getElementById('AvatarImage');
        var cropper = new Cropper(target,{aspectRatio: 1 / 1});
        // トリミングボタンを押したとき
        $('#AvatarSubmit').on('click', function() {
            // トリミングパネル内のcanvasを取得
            var canvas = cropper.getCroppedCanvas();
            // canvasをbase64に変換
            var data = canvas.toDataURL("image/png");
            var preview = document.getElementById('PreviewAvatar');
            // previewにセットする
            preview.src = data;
            // グローバル変数に代入
            image_avatar = data;
        });
    });

    // フォームの送信
    document.getElementById("formSubmit").onclick = function() {
        // 連続入力防止
        this.disabled = true;
        fetch('', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'enctype': 'multipart/form-data',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                // user_idはControllerで保存
                name: $('#nameInput').val(),
                name_id: name_id,
                content: $('#contentInput').val(),
                image_header: image_header,
                image_avatar: image_avatar,
            }),
        })
        .then(res => {
            window.location.reload();
        })
        .catch(error => {
            console.log(error);
        });
    };

    // 名前の入力を非同期で反映
    $('#nameInput').on('input', function(){
        var Base = 'ソビエト社会主義共和国連邦くん';
        var Target = $('#PreviewName');
        $(Target).html($(this).val());
        if($(this).val() === ''){
            $(Target).html(Base);
        }
    });

    // 自己紹介の入力を非同期で反映
    $('#contentInput').on('input', function(){
        var Base = `
            教育目標：健康で健全な技術者を育成する<br>
            1 豊かな心を育み、人間尊重の精神を培う<br>
            2 基礎基本となる知識・技術・技能を習得させ、創造性あふれる技術者を育成する<br>
            3 体を鍛えるとともに、社会の一員としての自覚を高めさせる<br>
            <br>
            目指す学校像<br>
            「ものづくりの精神」に基づき、豊かな人間性を育成するとともに、学力向上をとおして、生徒の自信を高め、地域に貢献できる技術者を育成する<br>
            <br>
            重点目標<br>
            1 基礎学力や専門知識・技術の習得を重視し、学習指導を充実させる<br>
            2 生徒指導及び進路指導の充実を図り、社会人基礎力を身につけさせる<br>
            3 開かれた学校づくりに取り組み、工業高校の魅力を積極的に発信する<br>
        `;
        var Target = $('#PreviewContent');
        $(Target).html($(this).val().replace(/\r?\n/g, '<br>'));
        if($(this).val() === ''){
            $(Target).html(Base);
        }
    });
</script>
@endsection