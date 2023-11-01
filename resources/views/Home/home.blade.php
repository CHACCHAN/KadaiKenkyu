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
                // カードタイトル
                $CardTitle = array(
                    1 => 'CHaserOnline',
                    2 => '三工技チャット',
                    3 => 'ローカルメモ',
                    4 => 'カレンダー',
                );
                // カード説明
                $CardBody = array(
                    1 => 'CHaserOnlineをすべてここに',
                    2 => 'わからないことを共有しよう!',
                    3 => 'ここだけをメモしよう!',
                    4 => 'Googleカレンダーとも連携!',
                );
                // カード更新日
                $CardLatest = array(
                    1 => '最終更新日: 2023年11月01日',
                    2 => '最終更新日: 2023年11月01日',
                    3 => '最終更新日: 2023年11月01日',
                    4 => '最終更新日: 2023年11月01日',
                );
                // カード写真
                $CardImage = array(
                    1 => asset('Home/Images/CHaserOnline.jpg'),
                    2 => asset('Home/Images/CHaserOnline.jpg'),
                    3 => asset('Home/Images/CHaserOnline.jpg'),
                    4 => asset('Home/Images/CHaserOnline.jpg'),
                );
                // カード最大数
                $MAX = 4;
            @endphp
            {{-- カード --}}
            @for($i=1;$i<=$MAX;$i++)
                <div class="col-12 col-md-3">
                    <a class="text-decoration-none" href="#">
                        <div id="CardHover" class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="border-end">
                                        <img src="{{ $CardImage[$i] }}" class="img-fluid rounded-start" alt="...">
                                    </div>                           
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $CardTitle[$i] }}</h4>
                                        <p class="card-text">{{ $CardBody[$i] }}</p>
                                        <p class="card-text"><small class="text-body-secondary">{{ $CardLatest[$i] }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection