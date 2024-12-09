@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/forum.css">
@endsection

@section('content')
    <div class="forum-container">
        <div class="chat-container" id="chat-container">
            @foreach ($chats as $chat)
                @if ($chat->user->id == auth()->user()->id)
                    <div class="bubble-container authed">
                        <div class="bubble-chat">
                            <div class="header-chat">
                                <strong class="sender-chat">{{ $chat->user->name }}</strong>
                                <img src="{{ $chat->user->getFirstMediaUrl() == '' ? '/img/profile/default.png' : $chat->user->getFirstMediaUrl() }}">
                            </div>
                            <p class="sender-chat">{{ $chat->message }}</p>
                            <small class="time-chat">{{ $chat->created_at }}</small>
                        </div>
                    </div>
                @else
                    <div class="bubble-container">
                        <div class="bubble-chat">
                            <div class="header-chat">
                                <img src="{{ $chat->user->getFirstMediaUrl() == '' ? '/img/profile/default.png' : $chat->user->getFirstMediaUrl() }}">
                                <strong class="sender-chat">{{ $chat->user->name }}</strong>
                            </div>
                            <p class="sender-chat">{{ $chat->message }}</p>
                            <small class="time-chat">{{ $chat->created_at }}</small>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="message-container">
            <input type="text" id="message-chat" name="message" placeholder="Type here..." maxlength="50" autofocus>
            <button id="sendMessage">Kirim</button>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/forum.js"></script>
@endsection
