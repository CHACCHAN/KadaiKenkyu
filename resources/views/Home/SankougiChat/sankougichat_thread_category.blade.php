@extends('Home.SankougiChat.sankougichat')
@section('CSS')
<style>
body {
    overflow: hidden;
}
.DateText {
    display: flex;
    align-items: center;
justify-content: center;
}
.DateText:before,
.DateText:after {
    border-top: 0.5px solid gray;
    content: "";
    width: 42%; 
}
.DateText:before {
    margin-right: 10px; 
}
.DateText:after {
    margin-left: 10px; 
}
</style>
@endsection
@section('view')
<div class="row">
    {{-- 上部メニューバー --}}
    <div class="col-12">
        <div class="border-bottom ps-2 p-1">
            <div class="row">
                <div class="col-2">
                    <a href="{{ url()->previous() }}" class="btn border-0 text-start text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- 左コンテンツ --}}
    <div class="col-12">
        <div class="row">
            <div class="col-3 p-0 border-end">
                {{-- タイトルヘッダ --}}
                <div class="h4 ps-3 py-2 m-0 bg-dark text-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cpu-fill" viewBox="0 0 16 16">
                        <path d="M6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                        <path d="M5.5.5a.5.5 0 0 0-1 0V2A2.5 2.5 0 0 0 2 4.5H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2A2.5 2.5 0 0 0 4.5 14v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14a2.5 2.5 0 0 0 2.5-2.5h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14A2.5 2.5 0 0 0 11.5 2V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5zm1 4.5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3A1.5 1.5 0 0 1 6.5 5z"/>
                    </svg>   {{ $sankougi_chat_thread->title }}
                </div>
                {{-- ヘッダ画像 --}}
                <img src="{{ asset('storage/sankougichat_thread/image/' . $sankougi_chat_thread->image) }}" alt="" width="100%">



                {{-- 設定カテゴリ一覧 --}}
                <div class="accordion accordion-flush">                   
                    <div class="accordion-item">
                        {{-- 設定チャンネル一覧 --}}
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed d-flex py-2" type="button" data-bs-toggle="collapse" data-bs-target="#SettingMenu" aria-expanded="false" aria-controls="SettingMenu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                </svg>
                                <div class="ms-1 fs-5">
                                    設定メニュー
                                </div>
                            </button>
                        </h2>
                        {{-- 設定チャンネル一覧 --}}
                        <div id="SettingMenu" class="accordion-collapse collapse">
                            <div class="accordion-body p-0">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>   スレッドの名前を変更
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front-fill" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                                        </svg>   スレッドの説明を編集
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                                        </svg>   スレッドの権限を編集
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- カテゴリ一覧 --}}
                    @foreach($sankougi_chat_thread_categorys as $sankougi_chat_thread_category)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    {{ $sankougi_chat_thread_category->title }}
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse @if(Request::is('sankougichat/thread/category/channel/id=' . $sankougi_chat_user->name_id . '/thread=' . $sankougi_chat_thread->id . '/category=' . $sankougi_chat_thread_category->id . '/*')) show @endif">
                                {{-- チャンネル一覧 --}}
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">
                                        {{-- チャンネル --}}
                                        @foreach($sankougi_chat_thread_channels as $sankougi_chat_thread_channel)
                                            @if($sankougi_chat_thread_channel->sankougi_chat_thread_category_id == $sankougi_chat_thread_category->id)
                                                <a href="{{ route('Home.sankougichat.thread.channel', [
                                                    'name_id' => $sankougi_chat_user->name_id,
                                                    'sankougi_chat_thread_id' => $sankougi_chat_thread->id,
                                                    'sankougi_chat_thread_category_id' => $sankougi_chat_thread_category->id,
                                                    'sankougi_chat_thread_channel_id' => $sankougi_chat_thread_channel->id,
                                                ]) }}" class="btn list-group-item list-group-item-action @if(Request::is('sankougichat/thread/category/channel/id=' . $sankougi_chat_user->name_id . '/thread=' . $sankougi_chat_thread->id . '/category=' . $sankougi_chat_thread_category->id . '/channel=' . $sankougi_chat_thread_channel->id)) active @endif">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
                                                        <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                                                    </svg>   {{ $sankougi_chat_thread_channel->title }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- チャット欄コンテンツ --}}
            @if(isset($sankougi_chat_thread_channel_chats))
                <div class="col-9 p-0">
                    {{-- チャンネルタイトル --}}
                    <div id="ChannelTitle" class="h4 ps-3 py-2 m-0 bg-secondary text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
                            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                        </svg>   {{ $sankougi_chat_thread_channel_title }}
                    </div>
                    {{-- ゲットされたチャットを表示 --}}
                    <div class="card h-75 border-0">
                        <div id="Chat_Content" class="card-body p-0 overflow-auto" style="height: 90vh;">
                            @foreach($sankougi_chat_thread_channel_chats as $sankougi_chat_thread_channel_chat)
                                @foreach($sankougi_chat_thread_channel_chat_users as $sankougi_chat_thread_channel_chat_user)
                                    @if($sankougi_chat_thread_channel_chat->chat_user_id == $sankougi_chat_thread_channel_chat_user->chat_user_id)
                                        {{-- 曜日変更時の日付 --}}
                                        @if(\Carbon\Carbon::now()->format('d') - $sankougi_chat_thread_channel_chat->created_at->format('d') != 0)
                                            <div class="DateText">{{ \Carbon\Carbon::now()->format('Y年m月d日 H時i分') }}</div>
                                        @endif
                                        {{-- チャット本体 --}}
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-1 p-3 pt-2 pb-0">
                                                        {{-- チャットした人のアイコン --}}
                                                        <img class="rounded-circle" src="https://media.discordapp.net/attachments/845634545800839171/1173755419475316736/IMG_9879.jpg?ex=65651beb&is=6552a6eb&hm=f66c35a4f3a07d87379eec8ef582254d1850c55724ff895d4cb43d71f48d507e&=&width=675&height=635" alt="" width="100%">
                                                    </div>
                                                    <div class="col-11 p-0">
                                                        <div class="d-flex">
                                                            {{-- チャットした人のユーザネーム --}}
                                                            <div class="fs-4 font-weight-bold">{{ $sankougi_chat_thread_channel_chat_user->name }}</div>
                                                            {{-- チャットした人のチャット日付 --}}
                                                            <div class="mt-2 ms-2 text-secondary">{{ $sankougi_chat_thread_channel_chat->created_at }}</div>
                                                        </div>
                                                        {{-- チャットコンテンツ --}}
                                                        <div class="fs-5">{{ $sankougi_chat_thread_channel_chat->content }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    {{-- チャット入力欄 --}}
                    <div class="d-flex px-2 pt-2 pe-4">
                        <div class="input-group">
                            <span class="input-group-text" id="ChatInputArea">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg>
                            </span>
                            <input type="text" class="form-control form-control-lg me-2" placeholder="メッセージを入力" aria-describedby="ChatInputArea">
                        </div>
                        <button id="SubmitChat" class="btn btn-primary" style="width: 100px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('jQuery')
<script type="text/javascript">

</script>
@endsection