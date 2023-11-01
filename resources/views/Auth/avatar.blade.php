@extends('Layouts.Account')
@section('title', 'アバター登録')
@section('CSS')
<style>
#AccountForm {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.cropper-area img {
  display: block;
  max-width: 100%;
}

#Design {
    box-shadow: 0 0 20px rgb(98, 0, 255);
}
</style>
@endsection
@section('content')
<div id="AccountForm">
    <div id="Design" class="card overflow-auto p-3 w-50 h-50">
        <div class="row">
            <div class="col-12 col-md-6">
                <form id="FormArea" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ImageFormFile" class="form-label m-0">アバター画像を登録</label>
                        <hr>
                        <input class="form-control" type="file" id="ImageFormFile" name="image" required>
                    </div>
                </form>
                @if(session('user_name'))
                    <div class="h5">
                        {{ session('user_name') }}さん、ようこそ！
                        <hr>
                    </div>
                @endif
                <div class="row">
                    <div class="col-6">
                        <button form="FormArea" type="submit" id="submit-btn" class="btn btn-success w-100">登録する</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100" id="crop-btn">トリミング</button>
                    </div>
                </div>
                <hr>
                <div class="cropper-area mt-2 mb-3">
                    <img id="cropper-img" src="">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <p>プレビュー</p>
                <hr>
                <div class="result">
                    <img id="result-img" class="pe-2 pb-2" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="module">
$(document).ready(function() {
    var cropperImg = document.getElementById('cropper-img');
    var cropper = new Cropper(cropperImg, {
        aspectRatio: 1, // アスペクト比を1:1に設定
    });

    $("#ImageFormFile").on("change", function() {
        var selectedFile = this.files[0];

        if (selectedFile) {
            var reader = new FileReader();

            reader.onload = function(event) {
                var fileData = event.target.result;

                // クロッパーにファイルデータを渡す
                cropper.replace(fileData);

                // 画像のプレビューのためにも img 要素の src 属性を変更
                $("#cropper-img").attr("src", fileData);
            };

            reader.readAsDataURL(selectedFile);
        }
    });

    $("#crop-btn").on("click", function() {
        var resultImgUrl = cropper.getCroppedCanvas().toDataURL();
        var result = document.getElementById('result-img');
        result.src = resultImgUrl;
    });

    $("#submit-btn").on("click", function() {
    var resultImgUrl = cropper.getCroppedCanvas().toDataURL();

    // プレビューの画像データを取得
    var resultImageData = resultImgUrl.split(',')[1];
    console.log("resultImageData: ", resultImageData);

    // input タグに新しいファイルを設定
    var inputFile = document.getElementById('ImageFormFile');
    var blob = base64ToBlob(resultImageData, 'image/jpeg'); // MIME タイプに合わせて変更
    console.log("blob: ", blob);
    var croppedFile = new File([blob], "cropped_image.jpg");
    console.log("croppedFile: ", croppedFile);

    // input タグに新しいファイルを設定
    inputFile.files = new FileList([croppedFile]);
    console.log("Input file:", inputFile.files);
    });
});
</script>
@endsection