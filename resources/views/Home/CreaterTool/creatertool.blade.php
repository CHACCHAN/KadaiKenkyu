@extends('Layouts.Default')
@section('title', 'クリエイターツール')
@section('content')
<div class="row">
    <div class="col-2 border-end">
        <div class="row">
            <div class="con-12 bg-primary border-bottom">
                <div class="p-2 mb-0 h4 text-center text-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                        <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                    </svg>   ツールを選択
                </div>
            </div>
            @php 
                $Contents = array(
                    array(
                        'Title'  => '原稿用紙エディタ',
                        'Link'   => route('Home.creatertool.genkoyoushi'),
                    ),
                );
            @endphp
            <div class="col-12 p-0">
                <ul class="list-group list-group-flush">
                    @foreach($Contents as $Content)
                        <a href="{{ $Content['Link'] }}" class="text-decoration-none text-dark h5">
                            <li class="list-group-item border-0 border-bottom">
                                {{ $Content['Title'] }}
                                @if(Request::url() == $Content['Link'])
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-caret-left-fill mb-1" viewBox="0 0 16 16">
                                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                                    </svg>
                                @endif
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        @yield('view')
    </div>
</div>
@endsection
@section('jQuery')
@endsection
