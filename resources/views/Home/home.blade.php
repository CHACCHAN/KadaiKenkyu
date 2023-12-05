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
        <div class="col-2 p-0 border-end">
            <div class="p-2 h4 border-bottom text-center bg-primary text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg>   クイックアクセス
            </div>
        </div>
        {{-- サービス一覧 --}}
        <div class="col-10 p-0 bg-light">
            <div class="p-2 h4 border-bottom text-center bg-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hdd-network" viewBox="0 0 16 16">
                    <path d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM3 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8.5v3a1.5 1.5 0 0 1 1.5 1.5h5.5a.5.5 0 0 1 0 1H10A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5H.5a.5.5 0 0 1 0-1H6A1.5 1.5 0 0 1 7.5 10V7H2a2 2 0 0 1-2-2V4zm1 0v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1zm6 7.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5z"/>
                </svg>   サービス一覧
            </div>
            <div class="row px-2">
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
                            'Card_Image'  => asset('Home/Images/SankougiChat.png'),
                            'Card_Link'   => route('Home.sankougichat'),
                        ),
                        array(
                            'Card_Title'  => 'ローカルメモ',
                            'Card_Body'   => 'ここだけをメモしよう!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/LocalMemo.png'),
                            'Card_Link'   => route('Home.localmemo'),
                        ), 
                        array(
                            'Card_Title'  => 'カレンダー',
                            'Card_Body'   => 'Googleカレンダーとも連携!',
                            'Card_Date'   => '最終更新日: 2023年11月01日',
                            'Card_Image'  => asset('Home/Images/Calender.png'),
                            'Card_Link'   => route('Home.calendar'),
                        ),
                        array(
                            'Card_Title'  => '入退室フォーム',
                            'Card_Body'   => '実習室の利用はこちらより',
                            'Card_Date'   => '最終更新日: 2023年12月05日',
                            'Card_Image'  => asset('Home/Images/Calender.png'),
                            'Card_Link'   => route('Home.joinout'),
                        )
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
                {{-- ゲーム一覧 --}}
                <div class="col-12 p-0">
                    <div class="p-2 h4 border-top border-bottom text-center bg-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-controller" viewBox="0 0 16 16">
                            <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
                            <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
                        </svg>   ゲーム一覧
                    </div>
                </div>
                {{-- カード --}}
                @php
                    // カードコンテンツ
                    $CardContents = array(
                        array(
                            'Card_Title'  => 'ナンプレ',
                            'Card_Body'   => 'ナンプレを遊べるよ！',
                            'Card_Date'   => '最終更新日: 2023年12月05日',
                            'Card_Image'  => asset('Game/NumberPlate/Images/sudoku.png'),
                            'Card_Link'   => route('Game.numberplate'),
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