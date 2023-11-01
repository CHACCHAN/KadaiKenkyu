@extends('Profile.profile')
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
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    <div class="text-primary py-1">
                                        メールアドレスを変更する
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    <div class="text-primary py-1">
                                        CHaserOnlineを設定する
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
@endsection