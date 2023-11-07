@extends('Layouts.Default')
@section('title', 'CHaserOnline')
@section('CSS')
<style>
    body {
        overflow-x: hidden;
    }
</style>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
{{-- メニューボタン --}}
<div id="CHaserOnline">
    <div class="row">
        <div class="col-3">
        <button id="user" class="btn btn-secondary" type="button">
            ユーザ
        </button>
</div>
</div>
        <button id="server" class="btn btn-secondary" type="button">
            サーバ
        </button>
        <button id="wait" class="btn btn-secondary" type="button">
            待ち合わせ
        </button>
        @auth
            <button id="id" class="btn btn-success" type="button">
                IDをコピー
            </button>
            <button id="password" class="btn btn-danger" type="button">
                キーをコピー
            </button>
        @endauth
    </div>
    {{-- 本体 --}}
    <div class="container-fluid">
        <iframe id="user_show" src="http://www7019ug.sakura.ne.jp/CHaserOnline003/user/" width="100%" height="866"></iframe>
        <iframe id="server_show" src="http://www7019ug.sakura.ne.jp/CHaserOnline003/Server/" width="100%" height="866"></iframe>
        <iframe id="wait_show" src="http://www7019ug.sakura.ne.jp/CHaserOnline003/MeetingPlace/" width="100%" height="866"></iframe>
    </div>
</div>
@endsection


@section('jQuery')
<script type="module">
    $(document).ready(function() {
        // IDのコピー
        function copyToChaserID() {
            var chaserId = '{{ Auth::user()->chaser_id }}';
            var $tempTextarea = $("<textarea>");
            $("body").append($tempTextarea);
            $tempTextarea.val(chaserId).select();

            try {
                document.execCommand('copy');
            } catch (err) {
                alert("コピーに失敗しました。手動でコピーしてください。");
            } finally {
                $tempTextarea.remove();
            }
        }
        $("#id").click(function() {
            copyToChaserID();
        });

        // パスワードのコピー
        function copyToChaserPassword() {
            var chaserPassword = '{{ Auth::user()->chaser_password }}';
            var $tempTextarea = $("<textarea>");
            $("body").append($tempTextarea);
            $tempTextarea.val(chaserPassword).select();

            try {
                document.execCommand('copy');
            } catch (err) {
                alert("コピーに失敗しました。手動でコピーしてください。");
            } finally {
                $tempTextarea.remove();
            }
        }
        $("#password").click(function() {
            copyToChaserPassword();
        });

        // コンテンツの表示管理
        $('#user_show').show();
        $('#server_show').hide()
        $('#wait_show').hide();

        $('#user').on('click', function(){
            $('#user_show').show();
            $('#server_show').hide()
            $('#wait_show').hide();
        });
        $('#server').on('click', function(){
            $('#user_show').hide();
            $('#server_show').show()
            $('#wait_show').hide();
        });
        $('#wait').on('click', function(){
            $('#user_show').hide();
            $('#server_show').hide()
            $('#wait_show').show();
        });
    });
</script>

@endsection