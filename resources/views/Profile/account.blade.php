@extends('Profile.profile')
@section('view')
<div class="container-fluid">
    <div class="row">
        {{-- 見出し --}}
        <div class="col-12">
            <div class="text-center">
                <img class="rounded-circle mb-3" src="{{ asset('storage/avatar/'.Auth::user()->image) }}" width="10%" alt="">
                <div class="h2">ようこそ、{{ Auth::user()->name }}さん</div>
                <div class="h5 text-secondary">サービスの管理と設定などが行うことができます</div>
            </div>
        </div>
        {{-- 詳細 --}}
        <div class="col-12">
            <div class="mt-3">
                <div class="container">
                    <div class="row px-5">
                        @php
                            // 基本情報コンテンツ
                            $InfoseekContents = array(
                                array(
                                    'InfoTitle'   =>  'プロフィール画像',
                                    'InfoContent' =>  '自身のアバターを表示します',
                                    'InfoLink'    =>  '',
                                    'InfoType'    =>  'Image',
                                ),
                                array(
                                    'InfoTitle'   =>  '名前',
                                    'InfoContent' =>  Auth::user()->name,
                                    'InfoLink'    =>  '',
                                    'InfoType'    =>  'Quick',
                                ),
                                array(
                                    'InfoTitle'   =>  '学科番号',
                                    'InfoContent' =>  Auth::user()->class_id,
                                    'InfoLink'    =>  '',
                                    'InfoType'    =>  'Quick',
                                ),
                            );
                        @endphp
                        <div class="col-12">
                            <div class="border rounded mx-auto p-3 pb-0 mb-3 w-75">
                                <div class="h4">基本情報</div>
                                <div class="fs-6 text-secondary">Cアカウントのプロフィールを設定することができます</div>
                                <div class="list-group list-group-flush">
                                    @foreach($InfoseekContents as $InfoseekContent)
                                        <a href="{{ $InfoseekContent['InfoLink'] }}" class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ $InfoseekContent['InfoTitle'] }}
                                                </div>
                                                <div class="col-8">
                                                    {{ $InfoseekContent['InfoContent'] }}
                                                </div>
                                                <div class="col-1">
                                                    @if($InfoseekContent['InfoType'] == 'Image')
                                                        <img src="{{ asset('storage/avatar/' . Auth::user()->image) }}" width="100%" class="rounded-circle" alt="">
                                                    @elseif($InfoseekContent['InfoType'] == 'Quick')
                                                        <div class="text-end">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @php
                            // カードコンテンツ
                            $CardContents = array(
                                array(
                                    'Card_Title'  => 'メールアドレス',
                                    'Card_Body'   => '自身のメール状況を確認できます。メールアドレスの編集と更新はこちらから',
                                    'Card_Footer' => 'メールアドレスを変更する',
                                    'Card_Image'  => asset('Profile/Images/MailAddress.jpg'),
                                    'Card_Link'   => route('Auth.email'),
                                    'Card_View'   => Auth::user()->email,
                                ),
                                array(
                                    'Card_Title'  => 'CHaserOnline',
                                    'Card_Body'   => 'CHaserOnlineの情報と設定情報を確認できます。CHaserOnlineアカウントの更新はこちらから',
                                    'Card_Footer' => 'CHaserOnlineを設定する',
                                    'Card_Image'  => asset('Profile/Images/CHaser.jpg'),
                                    'Card_Link'   => route('Auth.chaser'),
                                    'Card_View'   => Auth::user()->chaser_id,
                                ),
                                array(
                                    'Card_Title'  => '学科番号',
                                    'Card_Body'   => '自身の学科番号を確認できます。学科番号の編集と更新はこちらから',
                                    'Card_Footer' => '学科番号を変更する',
                                    'Card_Image'  => asset('Profile/Images/Class.jpg'),
                                    'Card_Link'   => route('Auth.class'),
                                    'Card_View'   => Auth::user()->class_id,
                                ), 
                            );
                        @endphp
                        {{-- カード --}}
                        @foreach($CardContents as $CardContent)
                            <div class="col-6">
                                <div class="mb-3">
                                    <a class="btn border-0 w-100 p-0" href="{{ $CardContent['Card_Link'] }}">
                                        <div class="card text-start">
                                            {{-- カードボディ --}}
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- 左側コンテンツ --}}
                                                    <div class="col-8">
                                                        <div class="card-title h5">
                                                            {{ $CardContent['Card_Title'] }}
                                                        </div>
                                                        <div class="card-text">
                                                            {{ $CardContent['Card_Body'] }}
                                                        </div>
                                                        <blockquote class="blockquote mt-4 mb-0">
                                                            @if(!$CardContent['Card_View'])
                                                                <footer class="blockquote-footer">未登録です<br><br></footer>
                                                            @else
                                                                <footer class="blockquote-footer">あなたの{{ $CardContent['Card_Title'] }}は<br><mark>{{ $CardContent['Card_View'] }}</mark>です</footer>
                                                            @endif
                                                        </blockquote>
                                                    </div>
                                                    {{-- 右側コンテンツ --}}
                                                    <div class="col-4">
                                                        <img src="{{ $CardContent['Card_Image'] }}" width="100%" class="rounded-3 border" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- カードフッター --}}
                                            <div class="card-footer bg-light">
                                                <div class="text-start text-primary py-1">
                                                    {{ $CardContent['Card_Footer'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                   
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
@endsection