@extends('Profile.profile')
@section('CSS')
<style>
#CardHover:hover {
    background: rgb(231, 231, 231);
    transition: 0.3s;
}
</style>
@endsection
@section('view')
<div class="container-fluid">
    <div class="row">
        {{-- 見出し --}}
        <div class="col-12">
            <div class="text-center">
                <img class="rounded-circle mb-3" src="{{ asset('storage/avatar/'.Auth::user()->image) }}" width="10%" alt="">
                <div class="h2">ようこそ、{{ Auth::user()->name }}さん</div>
                <div class="h5 text-secondary">サービスの管理と設定などが行うことができます。</div>
            </div>
        </div>
        {{-- 詳細 --}}
        <div class="col-12">
            <div class="mt-3">
                <div class="container">
                    <div class="row px-5">
                        @php
                            // カードタイトル
                            $CardTitle = array(
                                1 => 'メールアドレス',
                                2 => 'CHaserOnline',
                                3 => 'パスワード'
                            );
                            // カードコンテンツ
                            $CardContent = array(
                                1 => '自身のメール状況を確認できます。メールアドレスの編集と更新はこちらから',
                                2 => 'CHaserOnlineの情報と設定情報を確認できます。CHaserOnlineアカウントの更新はこちらから',
                                3 => '自身のパスワードを確認できます。パスワードの編集と更新はこちらから'
                            );
                            // カードフッター
                            $CardFooter = array(
                                1 => 'メールアドレスを変更する',
                                2 => 'CHaserOnlineを設定する',
                                3 => 'パスワードを変更する',
                            );
                            // カードイメージ
                            $CardImage = array(
                                1 => '',
                                2 => '',
                                3 => '',
                            );
                            $MAX = 3;
                        @endphp
                        {{-- カード --}}
                        @for($i=1;$i<=$MAX;$i++)
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="card-title h5">
                                                        {{ $CardTitle[$i] }}
                                                    </div>
                                                    <div class="card-text">
                                                        {{ $CardContent[$i] }}
                                                    </div>
                                                </div>
                                                <div class="col-4">
    
                                                </div>
                                            </div>
                                        </div>
                                        <div id="CardHover" class="card-footer bg-light">
                                            <div class="text-primary py-1">
                                                {{ $CardFooter[$i] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection