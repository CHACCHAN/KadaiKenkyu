@extends('Layouts.Default')
@section('title', 'ホーム')
@section('CSS')
<style>
#CardHover:hover {
    background: rgb(231, 231, 231);
    transition: 0.3s;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-0 bg-dark">
            <div class="bg-secondary p-2 text-light h4 border-bottom border-light">
                メニュー
            </div>
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action d-flex">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold h3">ピックアップ</div>
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </button>
                <button type="button" class="list-group-item list-group-item-action">A third button item</button>
                <button type="button" class="list-group-item list-group-item-action">A fourth button item</button>
            </div>
        </div>
        <div class="col-10 mt-3">
            <div class="row">
                {{-- カード --}}
                @php
                    // カードコンテンツ
                    $CardContents = array(
                        array(
                            'Card_Title'  => 'CHaserOnline',
                            'Card_Body'   => 'CHaserOnlineをすべてここに',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/CHaserOnline.jpg'),
                            'Card_Link'   => route('Home.chaser'),
                        ),
                        array(
                            'Card_Title'  => '三工技チャット',
                            'Card_Body'   => 'わからないことを共有しよう!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/CHaserOnline.jpg'),
                            'Card_Link'   => route('Home.sankougichat'),
                        ),
                        array(
                            'Card_Title'  => 'ローカルメモ',
                            'Card_Body'   => 'ここだけをメモしよう!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/CHaserOnline.jpg'),
                            'Card_Link'   => route('Home.localmemo'),
                        ), 
                        array(
                            'Card_Title'  => 'カレンダー',
                            'Card_Body'   => 'Googleカレンダーとも連携!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/CHaserOnline.jpg'),
                            'Card_Link'   => '',
                        ), 
                    );
                @endphp
                @foreach($CardContents as $CardContent)
                    <div class="col-12 col-md-4">
                        <a class="text-decoration-none" href="{{ $CardContent['Card_Link'] }}">
                            <div id="CardHover" class="card mb-3 w-100">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="border-end">
                                            <img src="{{ $CardContent['Card_Image'] }}" class="img-fluid rounded-start" alt="...">
                                        </div>                           
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $CardContent['Card_Title'] }}</h4>
                                            <p class="card-text">{{ $CardContent['Card_Body'] }}</p>
                                            <p class="card-text"><small class="text-body-secondary">{{ $CardContent['Card_Date'] }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection