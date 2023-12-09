@extends('Layouts.default')
@section('title', '入退室フォーム')
@section('CSS')
<style>
    @keyframes Animation {
    0%, 100% {
        transform: rotate(10deg);
    }
    50% {
        transform: rotate(-10deg);
    }
}
    html,body {
        overflow: hidden
    }
    #PositionBack {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }
    #LoginButton:hover {
        filter: drop-shadow(0px 0px 10px black);
        animation: Animation 1s linear infinite;
    }
</style>
@endsection
@section('content')
<div class="row">
    @auth
        <div class="col-12">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="fs-4 px-2 my-2 text-light rounded-3" style="background: #6f42c1;">
                        ❚ 入退室フォーム
                    </div>
                    <form action="" method="POST">
                        @csrf
                        {{-- ステップ選択 --}}
                        <nav class="border-bottom my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li id="RegisterInfo" class="breadcrumb-item h5 text-decoration-underline">登録情報</li>
                                <li id="SelectRoom" class="breadcrumb-item h5">部屋選択</li>
                                <li id="Check" class="breadcrumb-item h5">確認</li>
                            </ol>
                        </nav>
                        {{-- 登録情報 --}}
                        <div id="RegisterInfoMenu">
                            {{-- 名前情報 --}}
                            <div class="card">
                                <div class="card-body">
                                    <p class="h5 text-secondary">入室者情報を入力してください</p>
                                    <label for="first_name" class="form-label m-0">苗字</label>
                                    <input type="text" class="form-control mb-3" id="first_name" name="first_name" placeholder="三郷" value="{{ Auth::user()->first_name }}" aria-describedby="basic-addon3 basic-addon4" required>
                                    <label for="last_name" class="form-label m-0">名前</label>
                                    <input type="text" class="form-control mb-3" id="last_name" name="last_name" placeholder="太郎" value="{{ Auth::user()->last_name }}" aria-describedby="basic-addon3 basic-addon4" required>
                                    <label for="class_id" class="form-label m-0">学科番号</label>
                                    <input type="text" class="form-control" id="class_id" name="class_id" placeholder="C21G000" value="{{ Auth::user()->class_id }}" aria-describedby="basic-addon3 basic-addon4" required>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <div id="RegisterInfoButton" class="btn btn-primary">次へ進む</div>
                                <script type="text/javascript">
                                    document.getElementById('RegisterInfoButton').addEventListener('click', () => {
                                        if(document.getElementById('first_name').value && document.getElementById('last_name').value && document.getElementById('class_id').value) {
                                            document.getElementById('RegisterInfo').classList.remove("text-decoration-underline");
                                            document.getElementById('SelectRoom').classList.add("text-decoration-underline");
                                            ChangeDisplay('none', 'block', 'none');
                                        } else {
                                            document.getElementById('FormSubmit').click();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        {{-- 部屋選択 --}}
                        <div id="SelectRoomMenu" style="display: none;">
                            {{-- 部屋情報 --}}
                            <div class="card">
                                <div class="card-body">
                                    <p class="h5 text-secondary">部屋を選択する</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="EnteredRoom" id="Room1" checked>
                                        <label id="Room1_Str" class="form-check-label" for="Room1">
                                            電子計算機実習室
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="EnteredRoom" id="Room2">
                                        <label id="Room2_Str" class="form-check-label" for="Room2">
                                            情報総合室
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- 利用情報 --}}
                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="h5 text-secondary">利用時刻を選択する</p>
                                    <input type="datetime-local" id="first_date" name="first_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}" required> から <input type="datetime-local" id="last_date" name="last_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}" required> まで
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div id="RegisterInfoBack" class="btn btn-secondary me-2">戻る</div>
                                <div id="SelectRoomButton" class="btn btn-primary">次へ進む</div>
                                <script type="text/javascript">
                                    document.getElementById('RegisterInfoBack').addEventListener('click', () => {
                                        document.getElementById('RegisterInfo').classList.add("text-decoration-underline");
                                        document.getElementById('SelectRoom').classList.remove("text-decoration-underline");
                                        ChangeDisplay('block', 'none', 'none');
                                    });
                                    document.getElementById('SelectRoomButton').addEventListener('click', () => {
                                        if(document.getElementById('first_date').value && document.getElementById('last_date').value) {
                                            document.getElementById('RegisterInfo').classList.remove("text-decoration-underline");
                                            document.getElementById('SelectRoom').classList.remove("text-decoration-underline");
                                            document.getElementById('Check').classList.add("text-decoration-underline");
                                            ChangeCheckString('checked_one', document.getElementById('first_name').value);
                                            ChangeCheckString('checked_two', document.getElementById('last_name').value);
                                            ChangeCheckString('checked_three', document.getElementById('class_id').value);
                                            if(document.getElementById('Room1').checked) {
                                                ChangeCheckString('checked_four', '電子計算機実習室');
                                            } else if(document.getElementById('Room2').checked) {
                                                ChangeCheckString('checked_four', '情報総合室');
                                            }
                                            ChangeCheckString('checked_five', document.getElementById('first_date').value);
                                            ChangeCheckString('checked_six', document.getElementById('last_date').value);
                                            document.getElementById('ErrCheck').value = 1;
                                            ChangeDisplay('none', 'none', 'block');
                                        } else {
                                            document.getElementById('FormSubmit').click();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        {{-- 確認 --}}
                        <div id="CheckMenu" style="display: none;">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="h5 text-secondary">登録情報</p>
                                    <label for="checked_one" class="form-label m-0">苗字</label>
                                    <input type="text" class="form-control mb-3" id="checked_one" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <label for="checked_two" class="form-label m-0">名前</label>
                                    <input type="text" class="form-control mb-3" id="checked_two" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <label for="checked_three" class="form-label m-0">学科番号</label>
                                    <input type="text" class="form-control mb-3" id="checked_three" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <p class="h5 text-secondary">部屋選択</p>
                                    <label for="checked_four" class="form-label m-0">部屋</label>
                                    <input type="text" class="form-control mb-3" id="checked_four" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <label for="checked_five" class="form-label m-0">開始利用時刻</label>
                                    <input type="text" class="form-control mb-3" id="checked_five" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <label for="checked_six" class="form-label m-0">終了利用時刻</label>
                                    <input type="text" class="form-control" id="checked_six" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    {{-- Submit対策 --}}
                                    <input type="text" id="ErrCheck" class="d-none" name="str" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div id="SelectRoomBack" class="btn btn-secondary me-2">戻る</div>
                                <button type="submit" id="FormSubmit" class="btn btn-primary">送信する</button>
                                <script type="text/javascript">
                                    document.getElementById('SelectRoomBack').addEventListener('click', () => {
                                        document.getElementById('RegisterInfo').classList.remove("text-decoration-underline");
                                        document.getElementById('SelectRoom').classList.add("text-decoration-underline");
                                        document.getElementById('Check').classList.remove("text-decoration-underline");
                                        ChangeDisplay('none', 'block', 'none');
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    @endauth
    @guest
        <div class="col-12 p-0">
            <div class="position-relative">
                <img src="{{ asset('Home/JoinOut/Images/background_cat.gif') }}" alt="" width="100%" style="height: 100vh;">
                <div id="PositionBack" class="position-absolute">
                    <div class="card">
                        <div class="card-header text-center bg-light h5">
                            にゃーにゃー🐈入退室フォーム
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                クリックでログイン
                            </div>
                            <a href="{{ route('Auth.login') }}" class="btn border-0">
                                <img src="{{ asset('Home/JoinOut/Images/Nikukyu_button.png') }}" id="LoginButton" class="mx-auto" alt="" width="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</div>
@endsection
@section('jQuery')
<script type="text/javascript">
    function ChangeCheckString(target, string) {
        document.getElementById(target).value = string;
    }

    function ChangeDisplay(first, two, three) {
        document.getElementById('RegisterInfoMenu').style.display = first;
        document.getElementById('SelectRoomMenu').style.display = two;
        document.getElementById('CheckMenu').style.display = three;
    }
</script>
@endsection