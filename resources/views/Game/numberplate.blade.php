@extends('Layouts.Default')
@section('title', 'ナンプレ')
@section('CSS')
    <link rel="stylesheet" href="{{ asset('Game/NumberPlate/CSS/style.css') }}">
@endsection
@section('content')
<body>
    <main>
        <h1>ナンプレ</h1><button id="btn" class="btn btn-primary">問題を変える</button>
        <a href="https://www.soumu.go.jp/johotsusintokei/whitepaper/ja/r03/html/nd131100.html">次の問題へ</a><br>
        <table class="main"></table>
        <table class="select"></table>
        <div class="box">
            <div class="check" onclick="check()">正解確認</div>
            <div class="remove" onclick="remove()">消すあ</div>
        </div><br>
        <h2></h2>
        <p id="PassageArea">(ここにカウントが表示されます)</p>
    </main>
    <div id="topSnack">
        <div class="topSnackMessege">
            <p>
                ナンプレは9×9のマスに1から9までの数字を埋めるゲームです。まず、各行、各列、および各3×3のブロック内に、同じ数字が重複しないように注意が必要です。最初に与えられる数字はヒントとなり、それを元に他のマスを埋めていくのが目的です。
                入れたいマスをクリックした後に、キーボードで数字を入力してマスを埋めることができます。
                同じヒントでも複数の答えがある場合があります。
            </p>
        </div>
        <button id="topSnackClose">&#10005;</button>
    </div>
    <div class="centering_parent">
        <span class="centering_item">
            <button id="fill-answers-button" class="btn btn-primary">すべての数字を埋める(答えを見る)</button>
        </span>
    </div>
    <center>
        <input type="button" value="カウント開始" id="startcount" onclick="startShowing();">
    </center>
</body>
@endsection
@section('jQuery')
    <script type="text/javascript" src="{{ asset('Game/NumberPlate/JS/main.js') }}"></script>
@endsection