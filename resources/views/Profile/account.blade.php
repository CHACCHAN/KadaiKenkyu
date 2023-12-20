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
                            // 基本情報コンテンツ設定
                            $InfoseekContents = array(
                                array(
                                    'InfoTitle'   =>  'プロフィール画像',
                                    'InfoContent' =>  '自身のアバターを表示します',
                                    'InfoLink'    =>  route('Auth.avatar'),
                                    'InfoType'    =>  'Image',
                                ),
                                array(
                                    'InfoTitle'   =>  '名前',
                                    'InfoContent' =>  Auth::user()->name,
                                    'InfoLink'    =>  route('Auth.name'),
                                    'InfoType'    =>  'Quick',
                                ),
                                array(
                                    'InfoTitle'   =>  '学科番号',
                                    'InfoContent' =>  Auth::user()->class_id,
                                    'InfoLink'    =>  route('Auth.class'),
                                    'InfoType'    =>  'Quick',
                                ),
                            );
                        @endphp
                        {{-- 基本情報コンテンツ --}}
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