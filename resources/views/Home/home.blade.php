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
    <div class="mt-3">
        <div class="row">
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
                        'Card_Link'   => '',
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
            {{-- カード --}}
            @foreach($CardContents as $CardContent)
                <div class="col-12 col-md-3">
                    <a class="text-decoration-none" href="{{ $CardContent['Card_Link'] }}">
                        <div id="CardHover" class="card mb-3" style="max-width: 540px;">
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
@endsection