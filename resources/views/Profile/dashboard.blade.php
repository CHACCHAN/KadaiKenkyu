@extends('Profile.profile')
@section('view')
<div class="container-fluid">
    <div class="row px-5">
        {{-- ラベル --}}
        <div class="col-12">
            <div class="h4">ダッシュボード</div>
        </div>
        {{-- 管理者権限 --}}
        @if(Auth::user()->admin_flag)
            <div class="col-12 mb-3">
                <div class="row">
                    {{-- 全アカウント詳細一覧 --}}
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="h5">登録アカウント情報</div>
                                {{-- 検索 --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </span>
                                    <input type="text" id="SearchInput" class="form-control" placeholder="ニックネームを入力" aria-describedby="basic-addon1">
                                    <span id="SearchButton" class="input-group-text btn btn-success border" style="width: 100px;">検索</span>
                                </div>
                                {{-- 表示 --}}
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-1">
                                                番号
                                            </div>
                                            <div class="col-6">
                                                名前(ニックネーム)
                                            </div>
                                            <div class="col-3">
                                                学科番号
                                            </div>
                                            <div class="col-2">
                                                権限
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ContinueShow">
                                        @foreach($users as $user)
                                            {{-- リスト --}}
                                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#AccountModal_{{ $user->id }}">
                                                <div class="row">
                                                    {{-- 番号 --}}
                                                    <div class="col-1">
                                                        {{ $user->id }}
                                                    </div>
                                                    {{-- 名前 --}}
                                                    <div class="col-6">
                                                        {{ $user->first_name }} {{ $user->last_name }}({{ $user->name }})@if($user->id == Auth::id()) : あなた @endif
                                                    </div>
                                                    {{-- 学科番号 --}}
                                                    <div class="col-3">
                                                        {{ $user->class_id }}
                                                    </div>
                                                    {{-- 権限 --}}
                                                    <div class="col-2">
                                                        @if($user->admin_flag)
                                                            管理者
                                                        @else
                                                            生徒
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                            {{-- モーダル --}}
                                            <div class="modal fade" id="AccountModal_{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-3">
                                                            <div class="row h5">
                                                                <div class="col-12 px-2">
                                                                    <div class="h4 m-0">基本情報</div>
                                                                </div>
                                                                <div class="card p-0 mb-3">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-3">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        ニックネーム :
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        {{ $user->name }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        苗字 :
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        {{ $user->first_name }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        名前 :
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        {{ $user->last_name }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 px-2">
                                                                    <div class="h4 m-0">登録情報</div>
                                                                </div>
                                                                <div class="card p-0 mb-1">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-3">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        メールアドレス:
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        {{ $user->email }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 mb-3">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        学科番号:
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        {{ $user->class_id }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="d-flex border-bottom">
                                                                                    <div class="text-secondary">
                                                                                        権限レベル:
                                                                                    </div>
                                                                                    <div class="ms-2">
                                                                                        @if($user->admin_flag)
                                                                                            管理者
                                                                                        @else
                                                                                            生徒
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card mb-3">
                                                                    <div class="card-body p-0 py-3">
                                                                        <div class="text-secondary">
                                                                            登録アバター
                                                                        </div>
                                                                        <img src="{{ asset('storage/avatar/' . $user->image) }}" class="rounded border" width="100%" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 px-2">
                                                                    <div class="h4 m-0">アカウント操作</div>
                                                                </div>
                                                                <div class="card p-0">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                @if($user->admin_flag)
                                                                                    <a href="{{ route('Profile.dashboard.account.downgrade', $user->id) }}" class="btn btn-danger">生徒へ降格</a>
                                                                                @else
                                                                                    <a href="{{ route('Profile.dashboard.account.upgrade', $user->id) }}" class="btn btn-success">管理者へ昇格</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- リスト --}}
                                    <button type="button" id="ReloadButton" class="btn border-0">
                                        続きを表示 ({{ $count }})
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 各種情報 --}}
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="h5">ピックアップ(上限10件)</div>
                                <div class="card mb-1 border-0">
                                    <div id="PickUpNotifical" class="card-body p-1 bg-success text-light rounded d-none">
                                        正常に送信されました
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header p-1 pb-0 bg-light border-0">
                                        タイトル
                                    </div>
                                    <div class="card-body p-1 pt-0">
                                        <textarea id="PickUpInputTitle" class="form-control border-0" rows="1" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header p-1 pb-0 bg-light border-0">
                                        コンテンツ
                                    </div>
                                    <div class="card-body p-1 pt-0">
                                        <textarea id="PickUpInputContent" class="form-control border-0" rows="5" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header p-1 pb-0 bg-light border-0">
                                        投稿タイプ
                                    </div>
                                    <div class="card-body p-1 pt-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="PickUpInputType" value="お知らせ" id="PickUpRadio1" checked>
                                            <label class="form-check-label" for="PickUpRadio1">
                                                お知らせ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="PickUpInputType" value="入試関連" id="PickUpRadio2">
                                            <label class="form-check-label" for="PickUpRadio2">
                                                入試関連
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="input-group">
                                            <input type="file" id="PickUpInputFile" class="form-control" id="inputGroupFile02">
                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        </div>
                                    </div>
                                    <div class="col-2 ps-0">
                                        <button id="PickUpSubmit" class="btn btn-success w-100">投稿</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="h5">ピックアップ履歴</div>
                                <ul class="list-group">
                                    <div id="ViewPickUpHistory"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- 一般権限 --}}
        @else
            <div class="col-12 mb-3">

            </div>
        @endif
    </div>
</div>
@endsection
@section('jQuery')
@if(session('message'))
<script type="module">
    var Message = '{{ session('message') }}';
    alert(Message);
</script>
@endif
<script type="text/javascript">
    let max = {{ $viewcount }};
    let SearchInput = document.getElementById('SearchInput');
    let SearchButton = document.getElementById('SearchButton');
    let SearchButtonDefault;
    let ContinueShow = document.getElementById('ContinueShow');
    let ReloadButton = document.getElementById('ReloadButton');

    // 検索
    SearchButton.addEventListener('click', () => {
        if(SearchInput.value) {
            SearchButtonDefault = SearchButton.innerHTML;
            SearchButton.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                検索中
            `;
            SearchButton.disabled = true;
            // Fetchでゲット
            fetch('{{ route('Profile.dashboard.account.search') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: SearchInput.value,
                }),
            })
            .then((response) => response.json())
            .then(res => {
                SearchButton.innerHTML = SearchButtonDefault;
                SearchButton.disabled = false;
                // 空にする
                ContinueShow.innerHTML = "";
                let user = res.users;

                for(let i in user) {
                    let permission = "";
                    if(user[i].admin_flag) {
                        permission = "管理者";
                    } else {
                        permission = "生徒";
                    }
                    
                    ContinueShow.insertAdjacentHTML('beforeend', ViewHtml(i, user, permission));
                }
            })
            .catch(error => {
                console.log(error);
            });
        }
    });

    // 一覧表示
    ReloadButton.addEventListener('click', () => {
        // ロード中
        ReloadButton.innerHTML = `
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `;

        // Fetchでゲット
        fetch('{{ route('Profile.dashboard.account.get') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                max: max = max + {{ $viewcount }},
            }),
        })
        .then((response) => response.json())
        .then(res => {
            // 元の表示に戻す
            ReloadButton.innerHTML = "続きを表示" + " " + "(" + res.count + ")";
            // 空にする
            ContinueShow.innerHTML = "";
            let user = res.users;

            for(let i in user) {
                let permission = "";
                if(user[i].admin_flag) {
                    permission = "管理者";
                } else {
                    permission = "生徒";
                }
                
                ContinueShow.insertAdjacentHTML('beforeend', ViewHtml(i, user, permission));
            }
        })
        .catch(error => {
            console.log(error);
        });
    });

    // HTMLを生成
    function ViewHtml(i, user ,permission) {
        let AccountControl = "";
        let MyAccount = "";
        if(permission === "管理者") {
            AccountControl = `
                <a href="{{ url()->current() }}/account/downgradeAccount/id=${user[i].id}" class="btn btn-danger">生徒へ降格</a>
            `;
        } else {
            AccountControl = `
                <a href="{{ url()->current() }}/account/upgradeAccount/id=${user[i].id}" class="btn btn-success">管理者へ昇格</a>
            `;
        }
        if(user[i].id === {{ Auth::id() }}) {
            MyAccount = ": あなた";
        }
        let html = `
            {{-- リスト --}}
            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#AccountModal_${user[i].id}">
                <div class="row">
                    {{-- 番号 --}}
                    <div class="col-1">
                        ${user[i].id}
                    </div>
                    {{-- 名前 --}}
                    <div class="col-6">
                        ${user[i].first_name + " " + user[i].last_name}(${user[i].name}) ${MyAccount}
                    </div>
                    {{-- 学科番号 --}}
                    <div class="col-3">
                        ${user[i].class_id}
                    </div>
                    {{-- 権限 --}}
                    <div class="col-2">
                        ${permission}
                    </div>
                </div>
            </button>
            {{-- モーダル --}}
            <div class="modal fade" id="AccountModal_${user[i].id}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="row h5">
                                <div class="col-12 px-2">
                                    <div class="h4 m-0">基本情報</div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        ニックネーム :
                                                    </div>
                                                    <div class="ms-2">
                                                        ${user[i].name}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        苗字 :
                                                    </div>
                                                    <div class="ms-2">
                                                        ${user[i].first_name}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        名前 :
                                                    </div>
                                                    <div class="ms-2">
                                                        ${user[i].last_name}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-2">
                                    <div class="h4 m-0">登録情報</div>
                                </div>
                                <div class="card p-0 mb-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        メールアドレス:
                                                    </div>
                                                    <div class="ms-2">
                                                        ${user[i].email}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        学科番号:
                                                    </div>
                                                    <div class="ms-2">
                                                        ${user[i].class_id}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex border-bottom">
                                                    <div class="text-secondary">
                                                        権限レベル:
                                                    </div>
                                                    <div class="ms-2">
                                                        ${permission}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body p-0 py-3">
                                        <div class="text-secondary">
                                            登録アバター
                                        </div>
                                        <img src="{{ asset('storage/avatar') }}/${user[i].image}" class="rounded border" width="100%" alt="">
                                    </div>
                                </div>
                                <div class="col-12 px-2">
                                    <div class="h4 m-0">アカウント操作</div>
                                </div>
                                <div class="card p-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                ${AccountControl}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        return html;
    }
</script>
<script type="text/javascript">
    let PickUpInputTitle = document.getElementById('PickUpInputTitle');
    let PickUpInputContent = document.getElementById('PickUpInputContent');
    let PickUpInputFile = document.getElementById('PickUpInputFile');
    let PickUpInputType = document.getElementsByName('PickUpInputType');
    let PickUpSubmit = document.getElementById('PickUpSubmit');
    let PickUpNotifical = document.getElementById('PickUpNotifical');
    let PickUpSubmitDefault;

    PickUpSubmit.addEventListener('click', () => {
        if(PickUpInputTitle.value && PickUpInputContent.value) {
            // 送信中(ボタン)
            PickUpSubmitDefault = PickUpSubmit.innerHTML;
            PickUpSubmit.disabled = true;
            PickUpSubmit.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                送信中
            `;

            if(PickUpInputFile.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    UploadPickUp(e, true);
                }

                reader.readAsDataURL(PickUpInputFile.files[0]);
            } else {
                UploadPickUp(false, false);
            }

            // 履歴に適用
            getData();

            function GetRadioValue() {
                for(let i = 0; i < PickUpInputType.length; i++) {
                    if(PickUpInputType.item(i).checked) {
                        return PickUpInputType.item(i).value;
                    }
                }
            }

            function UploadPickUp(e, mode) {
                let imageData = null;
                // Data-URL
                if(mode) {
                    imageData = e.target.result;
                }

                fetch('{{ route('Profile.dashboard.pickup.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'enctype': 'multipart/form-data',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        title: PickUpInputTitle.value,
                        content: PickUpInputContent.value,
                        image: imageData,
                        type: GetRadioValue(),
                    }),
                })
                .then((response) => response.json())
                .then(res => {
                    // 送信完了(ボタン)
                    PickUpSubmit.innerHTML = PickUpSubmitDefault;
                    PickUpSubmit.disabled = false;

                    // 入力欄のリセット
                    PickUpInputTitle.value = "";
                    PickUpInputContent.value = "";
                    PickUpInputFile.value = "";

                    // 通知
                    PickUpNotifical.classList.remove('d-none');
                    setTimeout(() => {
                        PickUpNotifical.classList.add('d-none');
                    }, 3000);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    });
</script>
<script type="text/javascript">
    let ViewPickUpHistory = document.getElementById('ViewPickUpHistory');
    let Time = 10000;

    // 読み込み中
    ViewPickUpHistory.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    // 初回取得
    getData();

    // 同期処理
    setInterval(() => {
        getData();
    }, Time);

    function getData() {
        fetch('{{ route('Profile.dashboard.pickup.get') }}')
        .then((response) => response.json())
        .then(res => {
            let pickup = res.pickups;
            let TypeClass;

            ViewPickUpHistory.innerHTML = "";
            ViewPickUpHistory.insertAdjacentHTML('beforeend', '最大10件中' + res.count + '件');

            for(let i in pickup) {
                if(pickup[i].type === "お知らせ") {
                    TypeClass = 'bg-success';
                } else {
                    TypeClass = 'bg-danger';
                }

                let html = `
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-8">
                                <div class="text-truncate">
                                    ${pickup[i].title}
                                </div>
                            </div>
                            <div class="col-3 px-0">
                                <div class="${TypeClass} text-center text-light">
                                    ${pickup[i].type}
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="text-center">
                                    <div id="DeletePickUpLoad_${pickup[i].id}" class="btn border-0 p-0" onclick="DeletePickUp(${pickup[i].id});">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `;

                ViewPickUpHistory.insertAdjacentHTML('beforeend', html);
            }
        })
        .catch(error => {
            console.log(error);
        });
    }

    function DeletePickUp(id) {
        let DeletePickUpLoad = document.getElementById('DeletePickUpLoad_' + id);

        DeletePickUpLoad.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `;

        fetch('{{ route('Profile.dashboard.pickup.delete') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'enctype': 'multipart/form-data',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
            }),
        })
        .then((response) => response.json())
        .then(res => {
            getData();
        })
        .catch(error => {
            console.log(error);
        });
    }
</script>
@endsection