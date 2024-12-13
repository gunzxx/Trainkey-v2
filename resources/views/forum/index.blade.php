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
                                <img
                                    src="{{ $chat->user->getFirstMediaUrl() == '' ? '/img/profile/default.png' : $chat->user->getFirstMediaUrl() }}">
                            </div>
                            <p class="sender-chat">{{ $chat->message }}</p>
                            <small class="time-chat">{{ $chat->created_at }}</small>
                        </div>
                    </div>
                @else
                    <div class="bubble-container">
                        <div class="bubble-chat">
                            <div class="header-chat">
                                <img
                                    src="{{ $chat->user->getFirstMediaUrl() == '' ? '/img/profile/default.png' : $chat->user->getFirstMediaUrl() }}">
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
            <button id="sendMessage">
                <svg fill="#000000" height="15px" width="15px" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 495.003 495.003" xml:space="preserve">
                    <g id="XMLID_51_">
                        <path id="XMLID_53_" d="M164.711,456.687c0,2.966,1.647,5.686,4.266,7.072c2.617,1.385,5.799,1.207,8.245-0.468l55.09-37.616
      l-67.6-32.22V456.687z" />
                        <path id="XMLID_52_" d="M492.431,32.443c-1.513-1.395-3.466-2.125-5.44-2.125c-1.19,0-2.377,0.264-3.5,0.816L7.905,264.422
      c-4.861,2.389-7.937,7.353-7.904,12.783c0.033,5.423,3.161,10.353,8.057,12.689l125.342,59.724l250.62-205.99L164.455,364.414
      l156.145,74.4c1.918,0.919,4.012,1.376,6.084,1.376c1.768,0,3.519-0.322,5.186-0.977c3.637-1.438,6.527-4.318,7.97-7.956
      L494.436,41.257C495.66,38.188,494.862,34.679,492.431,32.443z" />
                    </g>
                </svg>
            </button>
            {{-- <button id="sendMessage">Kirim</button> --}}
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/pusher.min.js"></script>
    <script src="/js/forum.js"></script>
@endsection
