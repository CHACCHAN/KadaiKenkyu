@extends('Layouts.Account')
@section('title', 'アバター登録')
@section('CSS')
<style>
#AvatarContent:hover {
    background: rgb(231, 231, 231);
}
</style>
@endsection
@section('content')
<div id="AccountForm">
    <div id="Design" class="card overflow-auto p-3 w-25" style="height: 75%;">
        <div class="row">
            {{-- プレビュー & 読み込みボタン --}}
            <div class="col-12 p-0">
                {{-- Default --}}
                <div class="p-2">
                    <div class="h4 text-center border-bottom border-dark">アバターを設定する</div>
                    <div class="text-secondary">クリックで読み込み</div>
                    <div id="DefaultView">
                        <label for="InputImage" id="AvatarContent" class="btn text-center border w-100" style="padding: 50% 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                            </svg>
                        </label>
                    </div>
                    <input type="file" name="image" id="InputImage" class="d-none" requried>
                </div>
                {{-- Canvas --}}
                <div class="m-2">
                    <img src="" id="AvatarView" width="100%" alt="">
                </div>
            </div>
            {{-- コントロールボタン欄 --}}
            <div class="col-12">
                <div class="text-end">
                    <button id="SubmitButton" class="btn btn-primary" onclick="SendData()" disabled>登録</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="text/javascript">
    var cropper = null;
    let SubmitButton = document.getElementById('SubmitButton');
    document.getElementById('InputImage').addEventListener('input', (e) => {
        // 元要素を非表示
        document.getElementById('DefaultView').style.display = 'none';

        // Canvasの準備
        let img = document.getElementById('AvatarView');
        let file = e.target.files[0];

        // Canvasの適用
        img.src = window.URL.createObjectURL(file);
        cropper = new Cropper(img,{aspectRatio: 1 / 1});

        // 送信ボタンの有効化
        SubmitButton.disabled = false;
    });

    function SendData() {
        // 画像の型を設定
        let canvas = cropper.getCroppedCanvas();
        let data = canvas.toDataURL("image/png");

        SubmitButton.disabled = true;
        SubmitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            送信中...
        `;

        fetch('{{ route('Auth.avatar') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'enctype': 'multipart/form-data',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                image: data,
            }),
        })
        .then((response) => response.json())
        .then(res => {
            window.location.href = res.link;
        })
        .catch(error => {
            console.log(error);
        });
    }
</script>
@endsection